<?php

namespace App\Http\Controllers;

use App\Category;
use App\Publisher;
use App\Story;
use App\TimelineStory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Solarium\Core\Client\Adapter;
use Solarium\Core\Client;

class TimelineStoryController extends Controller
{

    protected $client;
    protected $stop_word_array = array();
    public $opera_checker;
    // Constructor
    public function __construct(){

        $this->client = new \Solarium\Client;
        $stop_words = "a
a's
able
about
above
according
accordingly
across
actually
after
afterwards
again
against
ain't
all
allow
allows
almost
alone
along
already
also
although
always
am
among
amongst
an
and
another
any
anybody
anyhow
anyone
anything
anyway
anyways
anywhere
apart
appear
appreciate
appropriate
are
aren't
around
as
aside
ask
asking
associated
at
available
away
awfully
b
be
became
because
become
becomes
becoming
been
before
beforehand
behind
being
believe
below
beside
besides
best
better
between
beyond
both
brief
but
by
c
c'mon
c's
came
can
can't
cannot
cant
cause
causes
certain
certainly
changes
clearly
co
com
come
comes
concerning
consequently
consider
considering
contain
containing
contains
corresponding
could
couldn't
course
currently
d
definitely
described
despite
did
didn't
different
do
does
doesn't
doing
don't
done
down
downwards
during
e
each
edu
eg
eight
either
else
elsewhere
enough
entirely
especially
et
etc
even
ever
every
everybody
everyone
everything
everywhere
ex
exactly
example
except
f
far
few
fifth
first
five
followed
following
follows
for
former
formerly
forth
four
from
further
furthermore
g
get
gets
getting
given
gives
go
goes
going
gone
got
gotten
greetings
h
had
hadn't
happens
hardly
has
hasn't
have
haven't
having
he
he's
hello
help
hence
her
here
here's
hereafter
hereby
herein
hereupon
hers
herself
hi
him
himself
his
hither
hopefully
how
howbeit
however
i
i'd
i'll
i'm
i've
ie
if
ignored
immediate
in
inasmuch
inc
indeed
indicate
indicated
indicates
inner
insofar
instead
into
inward
is
isn't
it
it'd
it'll
it's
its
itself
j
just
k
keep
keeps
kept
know
knows
known
l
last
lately
later
latter
latterly
least
less
lest
let
let's
like
liked
likely
little
look
looking
looks
ltd
m
mainly
many
may
maybe
me
mean
meanwhile
merely
might
more
moreover
most
mostly
much
must
my
myself
n
name
namely
nd
near
nearly
necessary
need
needs
neither
never
nevertheless
new
next
nine
no
nobody
non
none
noone
nor
normally
not
nothing
novel
now
nowhere
o
obviously
of
off
often
oh
ok
okay
old
on
once
one
ones
only
onto
or
other
others
otherwise
ought
our
ours
ourselves
out
outside
over
overall
own
p
particular
particularly
per
perhaps
placed
please
plus
possible
presumably
probably
provides
q
que
quite
qv
r
rather
rd
re
really
reasonably
regarding
regardless
regards
relatively
respectively
right
s
said
same
saw
say
saying
says
second
secondly
see
seeing
seem
seemed
seeming
seems
seen
self
selves
sensible
sent
serious
seriously
seven
several
shall
she
should
shouldn't
since
six
so
some
somebody
somehow
someone
something
sometime
sometimes
somewhat
somewhere
soon
sorry
specified
specify
specifying
still
sub
such
sup
sure
t
t's
take
taken
tell
tends
th
than
thank
thanks
thanx
that
that's
thats
the
their
theirs
them
themselves
then
thence
there
there's
thereafter
thereby
therefore
therein
theres
thereupon
these
they
they'd
they'll
they're
they've
think
third
this
thorough
thoroughly
those
though
three
through
throughout
thru
thus
to
together
too
took
toward
towards
tried
tries
truly
try
trying
twice
two
u
un
under
unfortunately
unless
unlikely
until
unto
up
upon
us
use
used
useful
uses
using
usually
uucp
v
value
various
very
via
viz
vs
w
want
wants
was
wasn't
way
we
we'd
we'll
we're
we've
welcome
well
went
were
weren't
what
what's
whatever
when
whence
whenever
where
where's
whereafter
whereas
whereby
wherein
whereupon
wherever
whether
which
while
whither
who
who's
whoever
whole
whom
whose
why
will
willing
wish
with
within
without
won't
wonder
would
would
wouldn't
x
y
yes
yet
you
you'd
you'll
you're
you've
your
yours
yourself
yourselves
z
zero";
        $this->stop_word_array = explode(PHP_EOL, $stop_words);
    }

    public $category_names = array(1 => "Nigeria", 2 => "Politics", 3 => "Entertainment", 4 => "Sports", 5 => "Metro");


/**
* Display a listing of the timeline stories.
*
* @return Response
*/
    public function index()
    {

        $timeline_stories = array();
        $timeline_stories['top_stories'] = TimelineStory::timeLineStories();
        $paginator = new Paginator($timeline_stories['top_stories'], 50);
        $paginator->setPath('/');
        if($this->isOpera()){
            return view('index_opera')->with("data", array('timeline_stories' => $timeline_stories, 'publishers_name' => Publisher::$publishers, 'category_name' => $this->category_names))->with('paginator', $paginator);

        }else{
            return view('index')->with("data", array('timeline_stories' => $timeline_stories, 'publishers_name' => Publisher::$publishers, 'category_name' => $this->category_names))->with('paginator', $paginator);

        }

    }

    //returns paginated stories in json format
    public function getStoriesJson(){

        return TimelineStory::topStories()->paginate();
    }

    /**
     * Returns the view for the category requested
     *
     * @return Response
     */
    public function getStoriesByCat($category_name){
        $isOpera = $this->isOpera();
        try{
            $category_stories = array();
            $category_id = Category::$news_category[$category_name];
            $category_stories['category_name'] = $this->category_names[$category_id];
            $category_stories['all'] = TimelineStory::recentStoriesByCat($category_id);

            return view('category')->with('data', array('category_stories' => $category_stories, 'publishers_name' => Publisher::$publishers))->with('is_opera', $isOpera);
        }catch(\ErrorException $ex){
            return view('errors.404');
        }
    }

    //Latest Stories
    public function getLatestStories(){
        $nigeria = TimelineStory::recentStoriesByCat(1);
        $politics = TimelineStory::recentStoriesByCat(2);
        $entertainment = TimelineStory::recentStoriesByCat(3);
        $sports = TimelineStory::recentStoriesByCat(4);
        $metro = TimelineStory::recentStoriesByCat(5);

        $latest_stories = array_merge($nigeria, $politics, $entertainment, $sports, $metro);

        if($this->isOpera()){
            return view('latestStory_opera')->with('latest_stories', $latest_stories);
        }else{
            return view('latestStory')->with('latest_stories', $latest_stories);
        }

    }


    //Gets all the details of the full story and the related stories
    public function getFullStory($story_id){

        $full_story = array();
        $full_story['full_story'] = DB::table('timeline_stories')->where('story_id', $story_id)->get();

        $full_story['other_sources'] = Story::matches($story_id);

        $full_story['recent_stories'] = TimelineStory::recentStoriesByCatX($full_story['full_story'][0]['category_id'], $story_id);
        $full_story['category_names'] = $this->category_names;
        $full_story['publisher_names'] = Publisher::$publishers;
        $timezone = new \DateTimeZone('Africa/Lagos');

        $now = new \DateTime('now', $timezone);
        TimelineStory::updateStoryViews($story_id, $now);
        if($this->isOpera()){
            return view('fullStory_opera')->with('data', $full_story);

        }else{
            return view('fullStory')->with('data', $full_story);

        }

    }

    //Handles timeline request
    public function handleRequest($request_name){
        $isOpera = $this->isOpera();
        try{
            $request_array = explode('-', $request_name);
            if(count($request_array) > 1){
                return $this->getFullStory($request_array[count($request_array) - 1]) ;
            }else{
                return $this->getStoriesByCat($request_name);

            }
        }catch (\ErrorException $ex){
           return view('errors.404');
        } catch (NotFoundHttpException $nfe){
            return view('errors.404');
        }

    }

//    Creates the full story url
    public function makeStoryUrl($title, $id){
        $url = strtolower($title) ;

        $url = preg_replace("/[^a-z0-9_\s-]/", "", $url);
        //Clean up multiple dashes or whitespaces
        $url = preg_replace("/[\s-]+/", " ", $url);
        //Convert whitespaces and underscore to dash
        $url = preg_replace("/[\s_]/", "-", $url);
        return $url.'-'.($id);
//        return $this->getFullStory($id);
    }

    // Gets the time difference between the time a story is created and the current time
    public function getTimeDifference($start_date){
        date_default_timezone_set('Africa/Lagos');
        $date1 = new \DateTime($start_date);
        $date2 = new \DateTime();
        $diff_in_sec = $date2->getTimestamp() - $date1->getTimestamp();

        if ($diff_in_sec <= 60){
            return "Just now";
        }elseif($diff_in_sec > 60 && $diff_in_sec < 3600){
            if(intval($diff_in_sec/60) == 1){
                return "1 min ago";
            }else{
                return intval($diff_in_sec/60) ." mins ago";
            }
        }elseif($diff_in_sec > 3600 && $diff_in_sec < 86400){
            if(intval($diff_in_sec/3600) == 1){
                return "1 hr";
            }else{
                return intval($diff_in_sec/3600) ." hrs ago";
            }
        }elseif($diff_in_sec > 86400 && $diff_in_sec < 604800){
            if(intval($diff_in_sec/86400) == 1){
                return "1 day";
            }else{
                return intval($diff_in_sec/86400) ." days ago";
            }
        }


    }

    //Checks if the story is an old story
    public function isOldStory($created_date){
        $date = new \DateTime($created_date);
        $date_in_seconds = $date->getTimestamp();
        $diff = time() - $date_in_seconds;
        return ($diff > 43200);

    }

    public function searchStory(){
        $isOpera = $this->isOpera();

        set_time_limit(0);
        //the php code for insert for jide to put in the cron
//        $stories_array = array();
//        //adding document to solr
//        $updateQuery = $this->client->createUpdate();
//
//        $story1 = $updateQuery->createDocument();
//        $story1->id = ''; //return the id of the insert from PDO query and attach it here
//        $story1->title_en = '';
//        $story1->description_en = '';
//        $story1->image_url_t = '';
//        $story1->video_url_t = '';
//        $story1->url = '';
//        $story1->pub_id_i = '';
//        $story1->has_cluster_i = '';
//        //do this for all stories and keep adding them to the stories array
//        //when done continue to the nest line
//
//        array_push($stories_array, $story1);
//
//        $updateQuery->addDocuments($stories_array);
//        $updateQuery->addCommit();
//
//        $result = $this->client->update($updateQuery);
        /*
         * end of add
         */

        /*
         * search
         */
        $search_query = \Illuminate\Support\Facades\Input::get('search_query');

        $search_query_array = explode(' ', $search_query);
        $search_query_array = array_diff($search_query_array, $this->stop_word_array);

        $search_query = implode(" ", $search_query_array);

        $query = $this->client->createSelect();
        $query->setQuery($search_query);
        $dismax = $query->getDisMax();
        $dismax->setQueryFields('title_en^3 description_en^3');
        $query->addSort('score',$query::SORT_DESC);
        $resultSet = $this->client->select($query);

        $search_result = array();
        $z = 0;
        foreach($resultSet as $doc)
        {
//            $title1 = mb_convert_encoding($doc->title_en[0], "UTF-8", "Windows-1252");
//            $title1 = html_entity_decode($title, ENT_QUOTES, "UTF-8");
            $j = 0;
            for($i = 0; $i < count($search_query_array); ++$i) {
                if (strpos(strtolower($doc->title_en[0]), strtolower($search_query_array[$i])) !== false) {
                    $j = $j + 1;
                }
            }
            if ($j >= (count($search_query_array) - 1)){

                $arr = array();
                $arr['story_id'] = $doc->id;
                $arr['title'] = $doc->title_en[0];
                $arr['description'] = $doc->description_en;
                $arr['image_url'] = $doc->image_url_t;
                $arr['video_url'] = $doc->video_url_t;
                $arr['url'] = $doc->url;
                $arr['pub_id'] = $doc->pub_id_i;
                $arr['has_cluster'] = $doc->has_cluster_i;

                array_push($search_result, $arr);
                $z = $z + 1;
            }
        }

//        $found = $resultSet->getNumFound();
        $found = $z;
        $return = array(
            'search_query' => $search_query,
            'search_result' => $search_result,
            'found' => $found,
            'publisher_names' => Publisher::$publishers
        );

        if($this->isOpera()){
            return view('search_results_opera')->with('data', $return);
        }else{
            return view('search_results')->with('data', $return);
        }
      /*
        set_time_limit(120);
//        var_dump($return);
//        die();

        return view('search_results')->with('data', $return)->with('is_opera', $isOpera);

        /*
         * search via mysql
         */

//        var_dump($return);
//        die();
    }
    //Updates the linkout time and the number of linkouts when the user clicks on the continue to read option for each story
    public function readStory($story_id){
        TimelineStory::updateStoryLinkOuts($story_id, \Carbon\Carbon::now());
    }

    public function testRedis(){
        Redis::set('name', 'Jide');
        return Redis::get('name');
    }

    /*
     * auto suggest function
     */
    public function suggest($search_query){
        $suggestqry = $this->client->createSuggester();
        $suggestqry->setHandler('suggest');
        $suggestqry->setDictionary('suggest');

        $suggestqry->setQuery($search_query);
        $suggestqry->setCount(10);
        $suggestqry->setCollate(true);
        $suggestqry->setOnlyMorePopular(true);

        $resultset = $this->client->suggester($suggestqry);
        $suggested = array();
        foreach ($resultset as $term => $termResult) {
            foreach($termResult as $result){
                array_push($suggested, $result);
            }
        }
        return $suggested;
    }

    public function getStoryImage($story_title){

        $story_title_array = explode(' ', $story_title);
        $story_title_array = array_diff($story_title_array, $this->stop_word_array);

        $story_title = implode(" ", $story_title_array);
        $query = $this->client->createSelect();
        $query->setQuery($story_title);
        $dismax = $query->getDisMax();
        $dismax->setQueryFields('name^3');
        $query->addSort('score',$query::SORT_DESC);
        $resultSet = $this->client->select($query);

        $search_result = array();
        foreach($resultSet as $doc)
        {
            $j = 0;
            $image_name_array = explode("-", $doc->name);
            for($i = 0; $i < count($image_name_array); ++$i) {
                if (strpos(strtolower($story_title), strtolower($image_name_array[$i])) !== false) {
                    $j = $j + 1;
                }
            }
            if ($j >= (count($image_name_array) - 1)) {
                $arr = array();
                $arr['id'] = $doc->id;
                $arr['name'] = $doc->name;
                $arr['url'] = $doc->url;

                array_push($search_result, $arr);
                break;
            }
        }

        $found = $resultSet->getNumFound();

        $return = array(
            'search_result' => $search_result,
            'found' => $found
        );
        return $return;
    }

    public function test(){
        return $this->getStoryImage("Woman Tortured For Stealing Writes Police Commissioner");

    }

    private function isOpera(){
        $this->opera_checker = $_SERVER['HTTP_USER_AGENT'];

        return strpos(strtolower($this->opera_checker), "opera mini") !== false || strpos(strtolower($this->opera_checker), "opera mobi") !== false;
    }
}
