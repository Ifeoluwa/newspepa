--
-- Database: `newspepa`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `status`, `created_date`, `modified_date`) VALUES
(1, 'Nigeria', 1, '2015-06-18 10:30:24', '2015-06-18 10:30:24'),
(2, 'Politics', 1, '2015-06-18 10:30:24', '2015-06-18 10:30:24'),
(3, 'Entertainment', 1, '2015-06-18 10:30:24', '2015-06-18 10:30:24'),
(4, 'Sports', 1, '2015-06-18 10:30:24', '2015-06-18 10:30:24'),
(5, 'Metro', 1, '2015-06-18 10:30:24', '2015-06-18 10:30:24');

-- --------------------------------------------------------

--
-- Table structure for table `clusters`
--

CREATE TABLE IF NOT EXISTS `clusters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `cluster_pivot` int(11) NOT NULL,
  `matches` tinytext NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category_id` (`category_id`),
  KEY `fk_cluster_status` (`status_id`),
  KEY `fk_story_pivot` (`cluster_pivot`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

CREATE TABLE IF NOT EXISTS `feeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `pub_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `last_access` datetime NOT NULL,
  `refresh_period` int(5) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `category_id` int(5) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feed_category_id` (`category_id`),
  KEY `fk_feed_status` (`status_id`),
  KEY `fk_feed_publisher` (`pub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `feeds`
--

INSERT INTO `feeds` (`id`, `title`, `pub_id`, `url`, `last_access`, `refresh_period`, `status_id`, `category_id`, `created_date`, `modified_date`) VALUES
(1, 'Tribune News', 1, 'http://tribuneonlineng.com/taxonomy/term/16/all/feed', '2015-06-18 13:52:56', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
(2, 'Punch News', 2, 'http://www.punchng.com/news/feed', '2015-06-18 13:52:56', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
(3, 'Leadership News', 3, 'http://leadership.ng/feed', '2015-06-18 13:52:56', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
(4, 'KokoFeed News', 4, 'http://kokofeed.com/category/news/feed', '2015-06-18 13:52:56', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
(5, 'Nigerian Monitor News', 5, 'http://www.nigerianmonitor.com/category/3nigeriannews/feed', '2015-06-18 13:52:56', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
(6, 'Vanguard National News', 6, 'http://www.vanguardngr.com/category/national-news/feed', '2015-06-18 13:52:56', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
(8, 'Nigeria Guardian National News', 8, 'http://www.ngrguardiannews.com/news/national/feed', '2015-06-18 13:52:56', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
(9, 'Channels Television Headline News', 9, 'http://www.channelstv.com/category/headlines/feed', '2015-06-18 13:52:56', 15, 1, 1, '2015-06-18 13:52:56', '2015-06-18 13:52:56'),
(10, 'Stargist Entertainment', 10, 'http://stargist.com/feed/', '2015-06-18 14:01:57', 15, 1, 3, '2015-06-18 14:01:57', '2015-06-18 14:01:57'),
(11, 'Bella Naija Entertainment', 11, 'http://www.bellanaija.com/feed/', '2015-06-18 14:01:57', 15, 1, 3, '2015-06-18 14:01:57', '2015-06-18 14:01:57'),
(12, 'Linda Ikeji Entertainment News', 12, 'http://lindaikejimagazine.com/feed', '2015-06-18 14:01:57', 15, 1, 3, '2015-06-18 14:01:57', '2015-06-18 14:01:57'),
(13, 'Vanguard Entertainment News', 6, 'http://www.vanguardngr.com/category/entertainment/feed', '2015-06-18 14:01:57', 15, 1, 3, '2015-06-18 14:01:57', '2015-06-18 14:01:57'),
(14, 'Nigerian Monitor Entertainment News', 5, 'http://www.nigerianmonitor.com/category/1entertainment/feed', '2015-06-18 14:01:57', 15, 1, 3, '2015-06-18 14:01:57', '2015-06-18 14:01:57'),
(15, 'Goal.com', 13, 'http://www.goal.com/en-ng/feeds/news?fmt=rss&ICID=HP', '2015-06-18 14:38:10', 15, 1, 4, '2015-06-18 14:38:10', '2015-06-18 14:38:10'),
(16, 'Punch Sport news', 2, 'http://www.punchng.com/sports/feed', '2015-06-18 14:38:10', 15, 1, 4, '2015-06-18 14:38:10', '2015-06-18 14:38:10'),
(17, 'vanguard Nigeria Sport News', 6, 'http://www.vanguardngr.com/category/sports/feed/', '2015-06-18 14:38:10', 15, 1, 4, '2015-06-18 14:38:10', '2015-06-18 14:38:10'),
(18, 'Futaa Sport News', 14, 'http://www.futaa.com/rss/ng', '2015-06-18 14:38:10', 15, 1, 4, '2015-06-18 14:38:10', '2015-06-18 14:38:10'),
(19, 'Complete Sport News', 15, 'http://www.completesportsnigeria.com/feed/', '2015-06-18 14:38:10', 15, 1, 4, '2015-06-18 14:38:10', '2015-06-18 14:38:10'),
(20, 'Channels Television Sport News', 9, 'http://www.channelstv.com/category/sports/feed/', '2015-06-18 14:38:10', 15, 1, 4, '2015-06-18 14:38:10', '2015-06-18 14:38:10'),
(21, 'Punch Politics News', 2, 'http://www.punchng.com/sports/feed', '2015-06-18 15:04:35', 15, 1, 4, '2015-06-18 15:04:35', '2015-06-18 15:04:35'),
(22, 'Vanguard Nigeria Politics News', 6, 'http://www.vanguardngr.com/category/sports/feed/', '2015-06-18 15:04:35', 15, 1, 4, '2015-06-18 15:04:35', '2015-06-18 15:04:35'),
(23, 'Nigeria Guardian Politics News', 8, 'http://www.futaa.com/rss/ng', '2015-06-18 15:04:35', 15, 1, 4, '2015-06-18 15:04:35', '2015-06-18 15:04:35'),
(24, 'Channels Television Politics News', 9, 'http://www.channelstv.com/category/sports/feed/', '2015-06-18 15:04:35', 15, 1, 4, '2015-06-18 15:04:35', '2015-06-18 15:04:35'),
(25, 'Punch Metro News', 2, 'http://www.punchng.com/sports/feed', '2015-06-18 15:08:45', 15, 1, 5, '2015-06-18 15:08:45', '2015-06-18 15:08:45'),
(26, 'Nigeria Guardian Sport News', 8, 'http://www.ngrguardiannews.com/news/metro/feed/', '2015-06-18 15:08:45', 15, 1, 5, '2015-06-18 15:08:45', '2015-06-18 15:08:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE IF NOT EXISTS `publishers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `url`, `status_id`, `created_date`, `modified_date`) VALUES
(1, 'Tribune Nigeria', 'http://tribuneonlineng.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
(2, 'Punch Nigeria', 'http://www.punchng.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
(3, 'Leadership', 'http://leadership.ng', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
(4, 'KokoFeed', 'http://kokofeed.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
(5, 'Nigerian Monitor', 'http://www.nigerianmonitor.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
(6, 'Vanguard Nigeria', 'http://www.vanguardngr.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
(7, 'The Cable', 'http://www.thecable.ng', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
(8, 'Nigeria Guardian', 'http://www.ngrguardiannews.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
(9, 'Channels Television', 'http://www.channelstv.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
(10, 'Star Gist', 'http://stargist.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
(11, 'BellaNaija', 'http://www.bellanaija.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
(12, 'Linda Ikeji', 'http://lindaikejimagazine.com/', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
(13, 'Goal.com', 'http://goal.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
(14, 'Futaa', 'http://www.futaa.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11'),
(15, 'Complete Sport', 'http://completesportsnigeria.com', 1, '2015-06-18 11:04:11', '2015-06-18 11:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `raw_stories`
--

CREATE TABLE IF NOT EXISTS `raw_stories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image_url` text NOT NULL,
  `video_url` text,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `pub_id` int(11) NOT NULL,
  `feed_id` int(11) NOT NULL,
  `category_id` int(5) NOT NULL,
  `status_id` int(5) NOT NULL DEFAULT '1',
  `pub_date` datetime NOT NULL,
  `insert_date` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `story_unique` (`url`,`pub_date`),
  KEY `fk_story_status_id` (`status_id`),
  KEY `fk_story_category` (`category_id`),
  KEY `fk_story_feed` (`feed_id`),
  KEY `fk_story_publisher` (`pub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `raw_stories`
--

INSERT INTO `raw_stories` (`id`, `title`, `image_url`, `video_url`, `description`, `content`, `url`, `pub_id`, `feed_id`, `category_id`, `status_id`, `pub_date`, `insert_date`, `created_date`, `modified_date`) VALUES
(2, 'Ex-Tribune editor, Akande, to become Osinbajo’s media aide', '', NULL, 'FORMER Saturday Tribune editor  Olaolu Akande  will this week be appointed by the president as a Senior Special Assistant to lead the media and communication unit in the office of Vice President Yemi Osinbajo  Nigerian Tribune gathered that Akande  also a former North American Bureau Chief of The Guardian  will work in the presidential media and communication office  but will be directly in charge of media relations issues that has to do with the vice president ', 'FORMER Saturday Tribune editor  Olaolu Akande  will this week be appointed by the president as a Senior Special Assistant to lead the media and communication unit in the office of Vice President Yemi Osinbajo  Nigerian Tribune gathered that Akande  also a former North American Bureau Chief of The Guardian  will work in the presidential media and communication office  but will be directly in charge of media relations issues that has to do with the vice president ', 'http://tribuneonlineng.com/content/ex-tribune-editor-akande-become-osinbajo%E2%80%99s-media-aide', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:13:47', '2015-06-22 11:13:47'),
(3, 'Govt appeals for peace in Kogi border communities', '', NULL, 'KOGI State government has appealed to the people living around the disputed boundary areas  especially the Aguleri in Anambra State and Ibaji in Kogi State  to embrace peace  Governor Idris Wada made the appeal when he received the Director-General of the National   Boundary Commission  Dr Muhammed Ahmed  who was on an advocacy visit to the governor over challenges faced by the commission in the on-going delineation of the boundary between Anambra and Kogi states ', 'KOGI State government has appealed to the people living around the disputed boundary areas  especially the Aguleri in Anambra State and Ibaji in Kogi State  to embrace peace  Governor Idris Wada made the appeal when he received the Director-General of the National   Boundary Commission  Dr Muhammed Ahmed  who was on an advocacy visit to the governor over challenges faced by the commission in the on-going delineation of the boundary between Anambra and Kogi states ', 'http://tribuneonlineng.com/content/govt-appeals-peace-kogi-border-communities', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:13:47', '2015-06-22 11:13:47'),
(4, 'Benue attacks worrisome –Al-Makura', '', NULL, 'NASARAWA State governor  Umaru Tanko Al-Makura  on Sunday  condemned the spate of attacks in Benue State  particularly on Tse-Ikpur community in Logo Local Government Area of the state by yet-to-be identified assailants  urging concerned parties to seek dialogue in resolving their differences  The governor made this known in a press statement signed by his Special Assistant on Media and Publicity  Alhaji Ahmed Tukur  a copy of which was made available to the Nigerian Tribune in Lafia  the state capital ', 'NASARAWA State governor  Umaru Tanko Al-Makura  on Sunday  condemned the spate of attacks in Benue State  particularly on Tse-Ikpur community in Logo Local Government Area of the state by yet-to-be identified assailants  urging concerned parties to seek dialogue in resolving their differences  The governor made this known in a press statement signed by his Special Assistant on Media and Publicity  Alhaji Ahmed Tukur  a copy of which was made available to the Nigerian Tribune in Lafia  the state capital ', 'http://tribuneonlineng.com/content/benue-attacks-worrisome-%E2%80%93al-makura', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:13:47', '2015-06-22 11:13:47'),
(5, 'Lack of credible leadership, Nigeria’s greatest problem  —Dogara', '', NULL, 'THE Speaker  House of Representatives  Rt Honourable Yakubu Dogara  on Sunday declared that Nigeria   s greatest problem was lack of credible leadership  even as he stated that his emergence as the speaker was an indication of the country   s unity  Speaking during a thanksgiving church service held at Church of Christ in Nations  COCIN  Centre in Tafawa Balewa town of Bauchi State  Dogara stated that if there were credible leaders at all levels  Nigeria would go places ', 'THE Speaker  House of Representatives  Rt Honourable Yakubu Dogara  on Sunday declared that Nigeria   s greatest problem was lack of credible leadership  even as he stated that his emergence as the speaker was an indication of the country   s unity  Speaking during a thanksgiving church service held at Church of Christ in Nations  COCIN  Centre in Tafawa Balewa town of Bauchi State  Dogara stated that if there were credible leaders at all levels  Nigeria would go places ', 'http://tribuneonlineng.com/content/lack-credible-leadership-nigeria%E2%80%99s-greatest-problem-%E2%80%94dogara', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:13:47', '2015-06-22 11:13:47'),
(6, 'My probe by Wike, fraudulent witch-hunt —Amaechi', '', NULL, 'IMMEDIATE past governor of Rivers State  Rotimi Amaechi  has described the setting up of a panel by his successor  Chief Nyesom Wike  to probe his administration as a sham and fraudulent witch-hunt meant to deceive the public  Amaechi  in a statement issued in Port Harcourt by his media office  on Sunday  alleged that Wike  by the probe  was only trying to rub his mud of corruption on him  Amaechi  and then grab media headlines with stories of    Amaechi   s alleged corrupt activities    ', 'IMMEDIATE past governor of Rivers State  Rotimi Amaechi  has described the setting up of a panel by his successor  Chief Nyesom Wike  to probe his administration as a sham and fraudulent witch-hunt meant to deceive the public  Amaechi  in a statement issued in Port Harcourt by his media office  on Sunday  alleged that Wike  by the probe  was only trying to rub his mud of corruption on him  Amaechi  and then grab media headlines with stories of    Amaechi   s alleged corrupt activities    ', 'http://tribuneonlineng.com/content/my-probe-wike-fraudulent-witch-hunt-%E2%80%94amaechi', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:13:47', '2015-06-22 11:13:47'),
(7, 'NLC chastises NASS members, says Nigerians need more sacrifice', '', NULL, 'THE Nigeria Labour Congress  NLC  has said the reduction of the budget of the National Assembly from N150 billion to N120 billion is not enough  saying that Nigerians need more sacrifice from them     It is not certainly far-reaching enough  The National Assembly members should appreciate the mood of the nation for leadership sacrifices  resource allocation for national development and common good as opposed to self helps ', 'THE Nigeria Labour Congress  NLC  has said the reduction of the budget of the National Assembly from N150 billion to N120 billion is not enough  saying that Nigerians need more sacrifice from them     It is not certainly far-reaching enough  The National Assembly members should appreciate the mood of the nation for leadership sacrifices  resource allocation for national development and common good as opposed to self helps ', 'http://tribuneonlineng.com/content/nlc-chastises-nass-members-says-nigerians-need-more-sacrifice', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:13:47', '2015-06-22 11:13:47'),
(8, 'Tambuwal charges FRSC on overloading', '', NULL, 'SOKOTO State governor  Aminu Tambuwal  has charged the Federal Road Safety Corps  FRSC  to initiate strict measures that could address the menace of overloading in the state  pledging the support of the state government in achieving the goal  Tambuwal gave the charge while receiving the Corps Marshal of FRSC  Boboye Oyeyemi and members of his entourage at the Government House  Sokoto  over the weekend ', 'SOKOTO State governor  Aminu Tambuwal  has charged the Federal Road Safety Corps  FRSC  to initiate strict measures that could address the menace of overloading in the state  pledging the support of the state government in achieving the goal  Tambuwal gave the charge while receiving the Corps Marshal of FRSC  Boboye Oyeyemi and members of his entourage at the Government House  Sokoto  over the weekend ', 'http://tribuneonlineng.com/content/tambuwal-charges-frsc-overloading-0', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:13:47', '2015-06-22 11:13:47'),
(9, 'Find means to pay workers’ salaries, NGE tells govs', '', NULL, 'THE Nigerian Guild of Editors  NGE  has called on states currently owing workers    salary in the country to explore    available avenues to alleviate the plights of the workers     NGE  in a communique issued in Abuja  at the weekend  at the end of a standing committee meeting  and signed by the Acting President and General Secretary  garba Deen Muhammad and Victoria Ibanga  respectively  decried the effect of the development on the nation   s economy ', 'THE Nigerian Guild of Editors  NGE  has called on states currently owing workers    salary in the country to explore    available avenues to alleviate the plights of the workers     NGE  in a communique issued in Abuja  at the weekend  at the end of a standing committee meeting  and signed by the Acting President and General Secretary  garba Deen Muhammad and Victoria Ibanga  respectively  decried the effect of the development on the nation   s economy ', 'http://tribuneonlineng.com/content/find-means-pay-workers%E2%80%99-salaries-nge-tells-govs', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:13:47', '2015-06-22 11:13:47'),
(10, 'Ekiti govt celebrates June 21 governorship victory', '', NULL, 'The celebration of the first anniversary of the victory of Governor Ayo Fayose of   the Poples Democratic Party    PDP  in Ekiti State governorship election kicked off with a thanksgiving service at the Government House Chapel in Ado Ekiti  on Sunday  According to a statement by the Chief Press Secretary to the Governor  Mr Idowu Adelusi    the celebrations continues today with various activities lined up for the celebration ', 'The celebration of the first anniversary of the victory of Governor Ayo Fayose of   the Poples Democratic Party    PDP  in Ekiti State governorship election kicked off with a thanksgiving service at the Government House Chapel in Ado Ekiti  on Sunday  According to a statement by the Chief Press Secretary to the Governor  Mr Idowu Adelusi    the celebrations continues today with various activities lined up for the celebration ', 'http://tribuneonlineng.com/content/ekiti-govt-celebrates-june-21-governorship-victory', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:13:47', '2015-06-22 11:13:47'),
(11, 'Let’s put our trust in God, Adeleke advises', '', NULL, 'THE first civilian governor of Osun State and senator representing Osun West District  Isiaka Adeleke  has called on Muslims in the state  to perform all duties associated with the holy month of Ramadan with dedication  the fear of God  selflessness and trust in almighty God  This was contained in a press release issued by his special adviser on media and public affairs  Olumide Lawal ', 'THE first civilian governor of Osun State and senator representing Osun West District  Isiaka Adeleke  has called on Muslims in the state  to perform all duties associated with the holy month of Ramadan with dedication  the fear of God  selflessness and trust in almighty God  This was contained in a press release issued by his special adviser on media and public affairs  Olumide Lawal ', 'http://tribuneonlineng.com/content/let%E2%80%99s-put-our-trust-god-adeleke-advises', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:13:47', '2015-06-22 11:13:47'),
(12, 'JNI prays for peace, urges state govts to support IDPs', '', NULL, 'THE Jama   atu Nasril Islam  JNI  has called on Muslims ummah to pray for the restoration of peace  stability and security in the country  just as it urges state governments to support Internally Displaced Persons  IDPs   In a press statement issued in Kaduna and signed by Dr Khalid Abubakar Aliyu  the group said the successful commencement of Ramadan in unison was indeed gratifying ', 'THE Jama   atu Nasril Islam  JNI  has called on Muslims ummah to pray for the restoration of peace  stability and security in the country  just as it urges state governments to support Internally Displaced Persons  IDPs   In a press statement issued in Kaduna and signed by Dr Khalid Abubakar Aliyu  the group said the successful commencement of Ramadan in unison was indeed gratifying ', 'http://tribuneonlineng.com/content/jni-prays-peace-urges-state-govts-support-idps', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:13:48', '2015-06-22 11:13:48'),
(13, 'Suspend creation of additional 39 LGs, PDP advises Aregbesola', '', NULL, 'OSUN State chapter of the Peoples Democratic Party  PDP   on Sunday  advised the state governor  Rauf Aregbesola  to suspend his plans to create additional 39 new local government councils in the state  In a statement issued in Osogbo by the party   s Director of Media and Strategy  Prince Diran Odeyemi  the party said    the reality in Osun calls for serious planning because the economy of the state now or even in near future cannot cope with bogus 69 local governments when it could not generate fund to develop the present 36 councils including an area office ', 'OSUN State chapter of the Peoples Democratic Party  PDP   on Sunday  advised the state governor  Rauf Aregbesola  to suspend his plans to create additional 39 new local government councils in the state  In a statement issued in Osogbo by the party   s Director of Media and Strategy  Prince Diran Odeyemi  the party said    the reality in Osun calls for serious planning because the economy of the state now or even in near future cannot cope with bogus 69 local governments when it could not generate fund to develop the present 36 councils including an area office ', 'http://tribuneonlineng.com/content/suspend-creation-additional-39-lgs-pdp-advises-aregbesola', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:13:48', '2015-06-22 11:13:48'),
(14, 'S/West PDP  wades into Lagos chapter’s crisis', '', NULL, 'The Peoples Democratic Party  PDP  in the South-West zone has waded into the crisis rocking its Lagos State chapter and called on leaders and members of the party in the state to sheathe their sword and give peace a chance  The zonal executive of the party said in a statement after a meeting  through its zonal publicity secretary  Mr Dare Omotosho  that the zonal executive of the party set-up a three-member committee which looked into the crisis  adding that the zonal executive had looked into the report ', 'The Peoples Democratic Party  PDP  in the South-West zone has waded into the crisis rocking its Lagos State chapter and called on leaders and members of the party in the state to sheathe their sword and give peace a chance  The zonal executive of the party said in a statement after a meeting  through its zonal publicity secretary  Mr Dare Omotosho  that the zonal executive of the party set-up a three-member committee which looked into the crisis  adding that the zonal executive had looked into the report ', 'http://tribuneonlineng.com/content/swest-pdp-wades-lagos-chapter%E2%80%99s-crisis', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:13:48', '2015-06-22 11:13:48'),
(15, 'MoU with Oyo govt yielding fruits  —NLC', '', NULL, 'THE Nigerian Labour Congress  Oyo State council has disclosed that the Memorandum of Understanding  MoU  and some other agreements signed with the state government has been fruitful  leading to the full payment of February 2015 salary of over 20 000   workers in the state  This development was made known in a press release entitled     Update on arrears of unpaid salaries in Oyo State  Information to workers     a copy which was made available to the Nigerian Tribune and signed by its chairman  Comrade Waheed Olojede ', 'THE Nigerian Labour Congress  Oyo State council has disclosed that the Memorandum of Understanding  MoU  and some other agreements signed with the state government has been fruitful  leading to the full payment of February 2015 salary of over 20 000   workers in the state  This development was made known in a press release entitled     Update on arrears of unpaid salaries in Oyo State  Information to workers     a copy which was made available to the Nigerian Tribune and signed by its chairman  Comrade Waheed Olojede ', 'http://tribuneonlineng.com/content/mou-oyo-govt-yielding-fruits-%E2%80%94nlc', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:13:48', '2015-06-22 11:13:48'),
(16, 'Oshodi-Isolo ex-LG boss wins libel case  ', '', NULL, 'A former chairman of Oshodi-Isolo Local Government Area of Lagos State  Honourable Afeez Ipesa-Balogun  has won a libel suit he instituted against Paradigm Communications Limited  Publishers of National Daily newspapers  In his judgment on the matter  Justice Lateef Abisola Okunnu of Court 26  Ikeja Judicial Division  also   awarded N10 million damages against the defendants for aggravated damages to the plantiff ', 'A former chairman of Oshodi-Isolo Local Government Area of Lagos State  Honourable Afeez Ipesa-Balogun  has won a libel suit he instituted against Paradigm Communications Limited  Publishers of National Daily newspapers  In his judgment on the matter  Justice Lateef Abisola Okunnu of Court 26  Ikeja Judicial Division  also   awarded N10 million damages against the defendants for aggravated damages to the plantiff ', 'http://tribuneonlineng.com/content/oshodi-isolo-ex-lg-boss-wins-libel-case', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:13:48', '2015-06-22 11:13:48'),
(17, '5 Mistakes To Avoid When Compiling Your CV', '<img width="300" height="216" src="http://leadership.ng/wp-content/uploads/2014/03/NIS-job-applicants-at-the-National-Stadium-Abuja-on-Saturday-March-15-2014-PHOTO-BY-KEHINDE-AJOBIEWE-300x216.gif" class="attachment-medium wp-post-image" alt="NIS-job-applicants-at-the-National-Stadium,-Abuja-on-Saturday,-March-15,-2014--PHOTO-BY-KEHINDE-AJOBIEWE" style="margin-bottom: 15px;" />', NULL, 'With high unemployment on the African continent  competition for every job opening is fierce  The first step towards securing your dream job is putting together a professional curriculum vitae  CV  that gets the recruiter excited about the skills  experience and qualifications you have to offer     But many great candidates fail at this first hurdle   ', 'With high unemployment on the African continent  competition for every job opening is fierce  The first step towards securing your dream job is putting together a professional curriculum vitae  CV  that gets the recruiter excited about the skills  experience and qualifications you have to offer     But many great candidates fail at this first hurdle   ', 'http://leadership.ng/features/442197/5-mistakes-to-avoid-when-compiling-your-cv', 3, 3, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:02', '2015-06-22 11:14:02'),
(18, 'CULTISM: Benue Residents Flee Community', '<img width="284" height="177" src="http://leadership.ng/wp-content/uploads/2015/03/Nigeria-Police.jpg" class="attachment-medium wp-post-image" alt="Nigeria Police" style="margin-bottom: 15px;" />', NULL, 'Residents of the Welfare Quarters area in Makurdi  Benue State  are fleeing the community for fear of being attacked by cultists terrorizing the place  There has been incessant cult clashes at the Welfare Quarters community since two months ago and this has paralyzed social and economic activities in the area  One person was stoned and   ', 'Residents of the Welfare Quarters area in Makurdi  Benue State  are fleeing the community for fear of being attacked by cultists terrorizing the place  There has been incessant cult clashes at the Welfare Quarters community since two months ago and this has paralyzed social and economic activities in the area  One person was stoned and   ', 'http://leadership.ng/news/442186/cultism-benue-residents-flee-community', 3, 3, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:02', '2015-06-22 11:14:02'),
(19, 'Buhari Appoints Laolu Akande As Vice-President Yemi Osinbajo’s Spokesperson', '', NULL, 'President Muhammadu Buhari appoints U S -based journalist  Mr Laolu Akande  as Vice-President Yemi Osinbajo  8217 s spokesperson ', 'President Muhammadu Buhari appoints U S -based journalist  Mr Laolu Akande  as Vice-President Yemi Osinbajo  8217 s spokesperson ', 'http://leadership.ng/news/442192/buhari-appoints-laolu-akande-as-vice-president-yemi-osinbajos-spokesperson', 3, 3, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:02', '2015-06-22 11:14:02'),
(20, 'Ramadan: Sultan Urges Muslims To Pray For Peace, Stability', '<img width="300" height="225" src="http://leadership.ng/wp-content/uploads/2014/06/sultan-of-sokoto-300x225.jpg" class="attachment-medium wp-post-image" alt="sultan of sokoto" style="margin-bottom: 15px;" />', NULL, 'The Sultan of Sokoto and President-General of Jama   atu Nasril Islam  JNI  yesterday called on Muslims to fervently pray for the restoration of peace  stability and security in the country  Sultan  in a statement signed by JNI   s secretary general  Dr  Khalid Abubakar Aliyu  also called on state governments and well to do individuals to extend benevolent   ', 'The Sultan of Sokoto and President-General of Jama   atu Nasril Islam  JNI  yesterday called on Muslims to fervently pray for the restoration of peace  stability and security in the country  Sultan  in a statement signed by JNI   s secretary general  Dr  Khalid Abubakar Aliyu  also called on state governments and well to do individuals to extend benevolent   ', 'http://leadership.ng/news/442187/ramadan-sultan-urges-muslims-to-pray-for-peace-stability', 3, 3, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:02', '2015-06-22 11:14:02'),
(21, 'Kaduna Moves To Check Ghost Workers', '<img width="300" height="225" src="http://leadership.ng/wp-content/uploads/2014/01/nasir_el-rufai-300x225.jpg" class="attachment-medium wp-post-image" alt="nasir_el-rufai" style="margin-bottom: 15px;" />', NULL, 'The Kaduna State government has concluded plans to commence biometric verification of all civil servants in its employment  The move  LEADERSHIP gathered is to checkmate the number of ghost workers under its payroll  The biometric verification exercise which is scheduled to commence Wednesday  24  is designed to provide the government an accurate and reliable record   ', 'The Kaduna State government has concluded plans to commence biometric verification of all civil servants in its employment  The move  LEADERSHIP gathered is to checkmate the number of ghost workers under its payroll  The biometric verification exercise which is scheduled to commence Wednesday  24  is designed to provide the government an accurate and reliable record   ', 'http://leadership.ng/news/442181/kaduna-moves-to-check-ghost-workers', 3, 3, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:02', '2015-06-22 11:14:02'),
(22, '‘Killing Of 13 Persons In Kaduna Condemnable’', '', NULL, 'A federal lawmaker from Kaduna State  Hon Sunday Marshal Katung yesterday condemned the killing of about 13 persons in some parts of the state  saying the act is unwarranted  Katung who represents Jaba Zangon federal constituency at the lower chamber of the National Assembly  wondered why some people will derive pleasure in maiming and killing fellow   ', 'A federal lawmaker from Kaduna State  Hon Sunday Marshal Katung yesterday condemned the killing of about 13 persons in some parts of the state  saying the act is unwarranted  Katung who represents Jaba Zangon federal constituency at the lower chamber of the National Assembly  wondered why some people will derive pleasure in maiming and killing fellow   ', 'http://leadership.ng/news/442180/killing-of-13-persons-in-kaduna-condemnable', 3, 3, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:02', '2015-06-22 11:14:02'),
(23, '‘Guide Your Children Over Negative Use Of Gadgets’', '', NULL, 'A Muslim cleric  Mr Razak Abdulsalam  has urged parents and teachers to guide children against the negative use of electronic gadgets brought by civilisation  to remain in faith with God  Abdulsalam gave the advice yesterday at the Annual Ramadan Public Lecture titled    8220 The Path to Self- fulfilment        organised by Movement for Islamic Culture and Awareness   ', 'A Muslim cleric  Mr Razak Abdulsalam  has urged parents and teachers to guide children against the negative use of electronic gadgets brought by civilisation  to remain in faith with God  Abdulsalam gave the advice yesterday at the Annual Ramadan Public Lecture titled    8220 The Path to Self- fulfilment        organised by Movement for Islamic Culture and Awareness   ', 'http://leadership.ng/news/442178/guide-your-children-over-negative-use-of-gadgets', 3, 3, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:02', '2015-06-22 11:14:02'),
(24, 'Buhari Knows What It Takes To Lead Nigeria – APC Chieftain', '<img width="300" height="225" src="http://leadership.ng/wp-content/uploads/2015/05/PRESIDENT-MUHAMMADU-BUHARI-300x225.jpg" class="attachment-medium wp-post-image" alt="GEN BUHARI RETURNED" style="margin-bottom: 15px;" />', NULL, 'A chieftain of the All Progressives Congress  APC  in Ekiti State  Chief Olusegun Osinkolu  has said that President Muhammadu Buhari knows what it takes to lead Nigeria and has secured the opportunity to offer it  Osinkolu who stated this while speaking with newsmen in his Ayede Ekiti country home  at the weekend noted  that President   ', 'A chieftain of the All Progressives Congress  APC  in Ekiti State  Chief Olusegun Osinkolu  has said that President Muhammadu Buhari knows what it takes to lead Nigeria and has secured the opportunity to offer it  Osinkolu who stated this while speaking with newsmen in his Ayede Ekiti country home  at the weekend noted  that President   ', 'http://leadership.ng/news/442179/buhari-knows-what-it-takes-to-lead-nigeria-apc-chieftain', 3, 3, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:02', '2015-06-22 11:14:02'),
(25, 'Tension In Osun Over Sale Of Property', '', NULL, 'Alleged plan by a new generation bank to sell its property located at the premises of the palace of the Ogiyan of Ejigbo in Osun State has started creating tension in the community  It was gathered that a branch of Skye bank located at the premises of the Ogiyan relocated to Ede few years back   ', 'Alleged plan by a new generation bank to sell its property located at the premises of the palace of the Ogiyan of Ejigbo in Osun State has started creating tension in the community  It was gathered that a branch of Skye bank located at the premises of the Ogiyan relocated to Ede few years back   ', 'http://leadership.ng/news/442177/tension-in-osun-over-sale-of-property', 3, 3, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:02', '2015-06-22 11:14:02'),
(26, 'Fasting May Boost Weight Loss, Improve Memory – Study', '<img width="300" height="225" src="http://leadership.ng/wp-content/uploads/2014/02/fasting-300x225.gif" class="attachment-medium wp-post-image" alt="fasting" style="margin-bottom: 15px;" />', NULL, 'Fasting has been found to be very good for health  In this piece  VICTOR OKEKE examines some research evidence for this claim  Many people say that it clears their mind and is a good way to detox  while others suggest that it can be damaging  Valter Longo  a gerontologist at the University of Southern California   ', 'Fasting has been found to be very good for health  In this piece  VICTOR OKEKE examines some research evidence for this claim  Many people say that it clears their mind and is a good way to detox  while others suggest that it can be damaging  Valter Longo  a gerontologist at the University of Southern California   ', 'http://leadership.ng/features/442174/fasting-may-boost-weight-loss-improve-memory-study', 3, 3, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:03', '2015-06-22 11:14:03'),
(27, '“I Won’t Re-Marry”-Fathia Balogun Addresses Marriage Controversy', '', NULL, 'Yoruba star actress and Saidi Balogun  8217 s ex-wife  Fathia Williams Balogun has said that she does not plan on getting married to another man again  Speaking in an interview with HipTV  she disclosed that making money and pursuing her career are the prominent things on her mind now and not getting another husband    8220 I won  8217 t re-marry        The post   8220 I Won  8217 t Re-Marry  8221 -Fathia Balogun Addresses Marriage Controversy appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'Yoruba star actress and Saidi Balogun  8217 s ex-wife  Fathia Williams Balogun has said that she does not plan on getting married to another man again  Speaking in an interview with HipTV  she disclosed that making money and pursuing her career are the prominent things on her mind now and not getting another husband    8220 I won  8217 t re-marry        The post   8220 I Won  8217 t Re-Marry  8221 -Fathia Balogun Addresses Marriage Controversy appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'http://stargist.com/naija-gist/i-wont-re-marry-fathia-balogun-addresses-marriage-controversy/', 10, 10, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:58', '2015-06-22 11:14:58'),
(28, '[PHOTO] Doting Dad! Davido Buys Matching Sneakers For Himself And Daughter', '', NULL, 'Davido proves he can also be doting daddy  The proud father of one took to his Instagram page to share a photo of his matching Buscemi sneakers for himself and his daughter  The post  PHOTO  Doting Dad  Davido Buys Matching Sneakers For Himself And Daughter appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'Davido proves he can also be doting daddy  The proud father of one took to his Instagram page to share a photo of his matching Buscemi sneakers for himself and his daughter  The post  PHOTO  Doting Dad  Davido Buys Matching Sneakers For Himself And Daughter appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'http://stargist.com/naija-gist/photo-doting-dad-davido-buys-matching-sneakers-for-himself-and-daughter/', 10, 10, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:58', '2015-06-22 11:14:58'),
(29, 'Stephanie Okereke And Husband Get Special Invitation To Buckingham Palace From Queen Of England', '', NULL, 'Popular Nollywood actress  Stephanie Okereke-Linus and husband  Linus Idahosa are heading to London to meet her Majesty the Queen of England at the 2015 edition of Queen   s Young Leaders Award    160  The actress and producer has been specially invited by the Queen of England to the awards ceremony and reception for 2015 winners at the       The post Stephanie Okereke And Husband Get Special Invitation To Buckingham Palace From Queen Of England appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'Popular Nollywood actress  Stephanie Okereke-Linus and husband  Linus Idahosa are heading to London to meet her Majesty the Queen of England at the 2015 edition of Queen   s Young Leaders Award    160  The actress and producer has been specially invited by the Queen of England to the awards ceremony and reception for 2015 winners at the       The post Stephanie Okereke And Husband Get Special Invitation To Buckingham Palace From Queen Of England appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'http://stargist.com/events/stephanie-okereke-and-husband-get-special-invitation-to-buckingham-palace-from-queen-of-england/', 10, 10, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:58', '2015-06-22 11:14:58'),
(30, 'Chidi Mokeme Shares A Cute Photo With His Son Noah', '', NULL, 'Proud dad  Chidi Mokeme celebrated Father  8217 s day with his son  Noah  The post Chidi Mokeme Shares A Cute Photo With His Son Noah appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'Proud dad  Chidi Mokeme celebrated Father  8217 s day with his son  Noah  The post Chidi Mokeme Shares A Cute Photo With His Son Noah appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'http://stargist.com/photos/chidi-mokeme-shares-a-cute-photo-with-his-son-noah/', 10, 10, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:58', '2015-06-22 11:14:58'),
(31, 'Photos From Dbanj’s Abuja Birthday Party', '', NULL, 'Kokomaster  D  8217 banj was  celebrated a the XO Lifestyle club  Abuja and amongst those in attendance was Terry G and John Fashanu  See more pictures below  The post Photos From Dbanj  8217 s Abuja Birthday Party appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'Kokomaster  D  8217 banj was  celebrated a the XO Lifestyle club  Abuja and amongst those in attendance was Terry G and John Fashanu  See more pictures below  The post Photos From Dbanj  8217 s Abuja Birthday Party appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'http://stargist.com/photos/photos-from-dbanjs-abuja-birthday-party/', 10, 10, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:58', '2015-06-22 11:14:58'),
(32, 'Aww! Read Omotola’s Touching Father’s Day Message To Her Late Father', '', NULL, 'Yesterday was fathers day and Nollywood star actress  Omotola Jalade took to Instagram to share a  picture of her late dad with a very heart melting message  Read her message below    8216 You were my first Bestfriend  my first confidant  my first boyfriend   8230  My first Director You thought me to think  to speak   to be strong        The post Aww  Read Omotola  8217 s Touching Father  8217 s Day Message To Her Late Father appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'Yesterday was fathers day and Nollywood star actress  Omotola Jalade took to Instagram to share a  picture of her late dad with a very heart melting message  Read her message below    8216 You were my first Bestfriend  my first confidant  my first boyfriend   8230  My first Director You thought me to think  to speak   to be strong        The post Aww  Read Omotola  8217 s Touching Father  8217 s Day Message To Her Late Father appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'http://stargist.com/home/aww-read-omotolas-touching-fathers-day-message-to-her-husband-of-29-years/', 10, 10, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:58', '2015-06-22 11:14:58'),
(33, 'D’Banj’s Father’s Day Message To His Dad Will Warm Your Heart', '', NULL, 'The Koko Master  D  8217 Banj decided to celebrate his dad in a heart-warming way today with a special message dedicated to him  Check it out    160  The post D  8217 Banj  8217 s Father  8217 s Day Message To His Dad Will Warm Your Heart appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'The Koko Master  D  8217 Banj decided to celebrate his dad in a heart-warming way today with a special message dedicated to him  Check it out    160  The post D  8217 Banj  8217 s Father  8217 s Day Message To His Dad Will Warm Your Heart appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'http://stargist.com/naija-gist/dbanjs-fathers-day-message-to-his-dad-will-warm-your-heart/', 10, 10, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:59', '2015-06-22 11:14:59'),
(34, '[PHOTO] Flavour Shows Off His Daughter Gabrielle With His Baby Mama, Sandra Okagbue', '', NULL, 'Highlife singer  Flavour decided to celebrate Father  8217 s day today by sharing a picture of his baby mama  Sandra Okagbue and his darling daughter  Gabrielle  Beautiful people  See below  The post  PHOTO  Flavour Shows Off His Daughter Gabrielle With His Baby Mama  Sandra Okagbue appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'Highlife singer  Flavour decided to celebrate Father  8217 s day today by sharing a picture of his baby mama  Sandra Okagbue and his darling daughter  Gabrielle  Beautiful people  See below  The post  PHOTO  Flavour Shows Off His Daughter Gabrielle With His Baby Mama  Sandra Okagbue appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'http://stargist.com/photos/photo-flavour-shows-off-his-daughter-gabrielle-with-his-baby-mama-sandra-okagbue/', 10, 10, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:59', '2015-06-22 11:14:59'),
(35, '[PHOTOS] Paul Okoye Gives Us More Reasons To Drool Over The Cute Okoye Kids', '', NULL, 'Paul Okoye who is currently in SA to shoot a new music video shared adorable family photos to celebrate Father  8217 s Day  His wife  son and nice are pictured in these new photos  The post  PHOTOS  Paul Okoye Gives Us More Reasons To Drool Over The Cute Okoye Kids appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'Paul Okoye who is currently in SA to shoot a new music video shared adorable family photos to celebrate Father  8217 s Day  His wife  son and nice are pictured in these new photos  The post  PHOTOS  Paul Okoye Gives Us More Reasons To Drool Over The Cute Okoye Kids appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'http://stargist.com/photos/photos-paul-okoye-gives-us-more-reasons-to-drool-over-the-cute-okoye-kids/', 10, 10, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:59', '2015-06-22 11:14:59'),
(36, '[PHOTOS] Charly Boy Parties Like A Rock Star To Celebrate His 64th Birthday', '', NULL, 'Charly Boy recently turned 64 and to celebrate his big day  the eccentric grand father had a nice party with his wife and friends on Friday at his home  See photos  The post  PHOTOS  Charly Boy Parties Like A Rock Star To Celebrate His 64th Birthday appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'Charly Boy recently turned 64 and to celebrate his big day  the eccentric grand father had a nice party with his wife and friends on Friday at his home  See photos  The post  PHOTOS  Charly Boy Parties Like A Rock Star To Celebrate His 64th Birthday appeared first on Nigerian Celebrity News   Latest Entertainment News  ', 'http://stargist.com/photos/photos-charly-boy-parties-like-a-rock-star-to-celebrate-his-64th-birthday/', 10, 10, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:14:59', '2015-06-22 11:14:59'),
(37, 'How does she keep up with Lagos Men? Watch Dolapo Oni in ‘Diary of a Lagos Girl’ with OC Ukeje, Alexx Ekubo, Liz Ameye & More', '', NULL, 'Dolapo Oni stars in new movie    Diary of a Lagos Girl    directed by  Jumoke Olatunde  and produced by  Nike Erinle  While the plot remains a mystery  the production team has released a teaser for the movie and it definitely looks like we will be keeping up with Dolapo Oni as she takes on Lagos  the most populated city    8230  ', 'Dolapo Oni stars in new movie    Diary of a Lagos Girl    directed by  Jumoke Olatunde  and produced by  Nike Erinle  While the plot remains a mystery  the production team has released a teaser for the movie and it definitely looks like we will be keeping up with Dolapo Oni as she takes on Lagos  the most populated city    8230  ', 'http://www.bellanaija.com/2015/06/22/how-does-she-keep-up-with-lagos-men-watch-dolapo-oni-in-diary-of-a-lagos-girl-with-oc-ukeje-alexx-ekubo-liz-ameye-more/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:06', '2015-06-22 11:15:06'),
(38, 'So Pretty! Check Out First Lady Aisha Buhari’s Official Portrait – PHOTO', '', NULL, 'According to several news sources including PM News  this is First Lady  Aisha Buhari  8216 s official portrait  Reports further state that henceforth  she will be addressed as   8220 Mrs  Aisha Muhammadu Buhari  Wife of President of the Federal Republic of Nigeria   8221  and not   8220 First Lady   8221  Photo Credit  PM News', 'According to several news sources including PM News  this is First Lady  Aisha Buhari  8216 s official portrait  Reports further state that henceforth  she will be addressed as   8220 Mrs  Aisha Muhammadu Buhari  Wife of President of the Federal Republic of Nigeria   8221  and not   8220 First Lady   8221  Photo Credit  PM News', 'http://www.bellanaija.com/2015/06/22/so-pretty-check-out-first-lady-aisha-buharis-official-portrait-photo/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:06', '2015-06-22 11:15:06'),
(39, 'New Music: Evelle – Kilimanjaro', '', NULL, 'Following the release of   8220 I am Naughty  8220   Universal Music Group artiste   8211   Evelle drops a  new track  titled   8220 Kilimanjaro  8220   Inspired by her life struggle to succeed among her peers and in the Nigerian music industry  the Nigerian Idol Season 4 winner described this joint as her first spiritual song  Press play  Listen to  Evelle   8211  Kilimanjaro Download', 'Following the release of   8220 I am Naughty  8220   Universal Music Group artiste   8211   Evelle drops a  new track  titled   8220 Kilimanjaro  8220   Inspired by her life struggle to succeed among her peers and in the Nigerian music industry  the Nigerian Idol Season 4 winner described this joint as her first spiritual song  Press play  Listen to  Evelle   8211  Kilimanjaro Download', 'http://www.bellanaija.com/2015/06/22/new-music-evelle-kilimanjaro/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:06', '2015-06-22 11:15:06'),
(40, 'LOL! Too Cute… Little Girl Inscribes “I Love My Dad” on Father’s Car with Screwdriver', '', NULL, 'What would you do if your child did this to your car  This little girl decided to show just how much she loved her dad on Father  8217 s Day  And so she inscribed   8220 I Love My Dad  8221  on her father  8217 s car using a screwdriver  The photo has since gone viral  LOL Photo Credit  Inquisitor', 'What would you do if your child did this to your car  This little girl decided to show just how much she loved her dad on Father  8217 s Day  And so she inscribed   8220 I Love My Dad  8221  on her father  8217 s car using a screwdriver  The photo has since gone viral  LOL Photo Credit  Inquisitor', 'http://www.bellanaija.com/2015/06/22/lol-too-cute-little-girl-inscribes-i-love-my-dad-on-fathers-car-with-screwdriver/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:06', '2015-06-22 11:15:06'),
(41, 'Always Turnt! See Photos as Iceprince, Terry G, Jimmy Jatt & More Light up The Place, Ikeja', '', NULL, 'Last Friday  Lagosians gathered at the all new The Place  Ikeja for an interesting night to remember with Remy Martin  for the club series  AtTheClubWithRemy  All performing acts from Orezi  CDQ  May D to Iceprince and surprise acts Terry G  Chocolate city  8216 s Dices Ailes and Yung Milli had the guests in the house jumping from    8230  ', 'Last Friday  Lagosians gathered at the all new The Place  Ikeja for an interesting night to remember with Remy Martin  for the club series  AtTheClubWithRemy  All performing acts from Orezi  CDQ  May D to Iceprince and surprise acts Terry G  Chocolate city  8216 s Dices Ailes and Yung Milli had the guests in the house jumping from    8230  ', 'http://www.bellanaija.com/2015/06/22/always-turnt-see-photos-as-iceprince-terry-g-jimmy-jatt-more-light-up-the-place-ikeja/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:06', '2015-06-22 11:15:06'),
(42, 'Big Brother Africa Lovers Pokello & Elikem Tie the Knot in Zimbabwe!', '', NULL, 'Controversial couple  Pokello Nare   38  Elikem Kumordzie  AKA Polikem who met on the set of the Big Brother Africa reality show  have finally said their I dos  The couple hinted at their upcoming union by posting a few of their pre-wedding shots on Instagram two days ago  wearing all white  and embracing each other outdoors    8230  ', 'Controversial couple  Pokello Nare   38  Elikem Kumordzie  AKA Polikem who met on the set of the Big Brother Africa reality show  have finally said their I dos  The couple hinted at their upcoming union by posting a few of their pre-wedding shots on Instagram two days ago  wearing all white  and embracing each other outdoors    8230  ', 'http://www.bellanaija.com/2015/06/22/big-brother-africa-lovers-pokello-elikem-tie-the-knot-in-zimbabwe/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:06', '2015-06-22 11:15:06'),
(43, 'Simi Tangos With Falz in “Jamb Question”! Watch', '', NULL, 'It   s humorous  intriguing and gushingly romantic  Simi received a big thumbs up for her latest hit single   8211    8220 Jamb Question  8220   Now we have a video  Shot in Abeokuta  by Mex  the story-themed visual features the Nigerian songbird in a romantic   8216 hot pursuit  8217  from Nigerian rapper   8211  Falz  Will the X3M Music act be releasing a full    8230  ', 'It   s humorous  intriguing and gushingly romantic  Simi received a big thumbs up for her latest hit single   8211    8220 Jamb Question  8220   Now we have a video  Shot in Abeokuta  by Mex  the story-themed visual features the Nigerian songbird in a romantic   8216 hot pursuit  8217  from Nigerian rapper   8211  Falz  Will the X3M Music act be releasing a full    8230  ', 'http://www.bellanaija.com/2015/06/22/simi-tangos-with-falz-in-jamb-question-watch/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:06', '2015-06-22 11:15:06'),
(44, 'The New Urban African Fashion? Sanusi Lagos presents Hip Street Wear with “PUSHAS” Collection', '', NULL, 'Here  8217 s some street wear for our urban fashionistas out there  From Nigerian designer   8211  Seyi Sanusi of street wear brand  Sanusi Lagos  comes the Spring Summer 2016 collection titled   8220 PUSHAS  8220   Created to take a new spin on the urban African fashion scene  the unisex collection was inspired by a fusion of influences inspired by the environment     8230  ', 'Here  8217 s some street wear for our urban fashionistas out there  From Nigerian designer   8211  Seyi Sanusi of street wear brand  Sanusi Lagos  comes the Spring Summer 2016 collection titled   8220 PUSHAS  8220   Created to take a new spin on the urban African fashion scene  the unisex collection was inspired by a fusion of influences inspired by the environment     8230  ', 'http://www.bellanaija.com/2015/06/22/the-new-urban-african-fashion-sanusi-lagos-presents-hip-street-wear-with-pushas-collection/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:06', '2015-06-22 11:15:06'),
(45, 'Chidinma Eke: Men Set the Bride Price for Other Men to Pay', '', NULL, 'It was thirty minutes to the commencement of the Financial Analysis exam  we were all seated in the hall  revising singularly or in little groups  and of course  some were gisting in groups as well  My mind drifted   8211  coming from a non-accounting background and with no interest in accounting  it didn   t take much for    8230  ', 'It was thirty minutes to the commencement of the Financial Analysis exam  we were all seated in the hall  revising singularly or in little groups  and of course  some were gisting in groups as well  My mind drifted   8211  coming from a non-accounting background and with no interest in accounting  it didn   t take much for    8230  ', 'http://www.bellanaija.com/2015/06/22/chidinma-eke-men-set-the-bride-price-for-other-men-to-pay/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:06', '2015-06-22 11:15:06'),
(46, 'Ambode Declares Tolls Will No Longer be Collected at 2nd Toll Point on Lekki-Epe Expressway', '', NULL, 'Lagos State governor Akinwunmi Ambode has declared that tolls will no longer be collected at the second toll point on the Lekki-Epe Expressway  Ambode announced the news during an interactive session with journalists in Lagos on Sunday  Punch reports  He further stated    8220 We must start thinking of the future concerning that road  We said we    8230  ', 'Lagos State governor Akinwunmi Ambode has declared that tolls will no longer be collected at the second toll point on the Lekki-Epe Expressway  Ambode announced the news during an interactive session with journalists in Lagos on Sunday  Punch reports  He further stated    8220 We must start thinking of the future concerning that road  We said we    8230  ', 'http://www.bellanaija.com/2015/06/22/ambode-declares-tolls-will-no-longer-be-collected-at-2nd-toll-point-on-lekki-epe-expressway/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:06', '2015-06-22 11:15:06');
INSERT INTO `raw_stories` (`id`, `title`, `image_url`, `video_url`, `description`, `content`, `url`, `pub_id`, `feed_id`, `category_id`, `status_id`, `pub_date`, `insert_date`, `created_date`, `modified_date`) VALUES
(47, 'First Photos: Mo Abudu, Ebuka Obi-Uchendu, Gbemi Olateru-Olagbegi, Fade Ogunro & More Attend Afternoon Tea with Professor Attahiru Jega', '', NULL, 'Ebonylife TV hosted Professor Attahiru Jega  the outgoing Chairman of the Independent National Electoral Commission  to a Q  38 A session with young professionals on Saturday  June 20th  at the Wheat Baker Hotel in Ikoyi  Lagos  The event  hosted by Ebuka Obi-Uchendu  was attended by Mo Abudu  Gbemi Olateru-Olagbegi  Tosyn   Bucknor  Fade Ogunro  Noble Igwe  Kemi Lala-Akindoju     8230  ', 'Ebonylife TV hosted Professor Attahiru Jega  the outgoing Chairman of the Independent National Electoral Commission  to a Q  38 A session with young professionals on Saturday  June 20th  at the Wheat Baker Hotel in Ikoyi  Lagos  The event  hosted by Ebuka Obi-Uchendu  was attended by Mo Abudu  Gbemi Olateru-Olagbegi  Tosyn   Bucknor  Fade Ogunro  Noble Igwe  Kemi Lala-Akindoju     8230  ', 'http://www.bellanaija.com/2015/06/22/first-photos-mo-abudu-ebuka-obi-uchendu-gbemi-olateru-olagbegi-fade-ogunro-more-attend-afternoon-tea-with-professor-attahiru-jega/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:06', '2015-06-22 11:15:06'),
(48, 'Atoke’s Monday Morning Banter: The Legitimacy of Illegitimacy', '', NULL, 'My cousin  Bayo started his career as a robber by nicking jewellery from my Aunty   s house  Bayo was a loose cannon     every time he came to the house  there was an unspoken red alert  hide all your valuable possessions  Every time my aunties and parents tried to understand why Bayo turned out to be    8230  ', 'My cousin  Bayo started his career as a robber by nicking jewellery from my Aunty   s house  Bayo was a loose cannon     every time he came to the house  there was an unspoken red alert  hide all your valuable possessions  Every time my aunties and parents tried to understand why Bayo turned out to be    8230  ', 'http://www.bellanaija.com/2015/06/22/atokes-monday-morning-banter-the-legitimacy-of-illegitimacy/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:06', '2015-06-22 11:15:06'),
(49, 'Ben Murray-Bruce Advises Pres. Buhari to Sell all Country’s Presidential Jets', '', NULL, 'Senator Ben Murray-Bruce is back again with more Twitter political commentary  This time  he is advising President Buhari to sell off all the country  8217 s presidential jets  and appoint a Minister for Common Sense  Read his tweets  We need a common sense revolution  Though I know its not practical  I almost wish  MBuhari would appoint a    8230  ', 'Senator Ben Murray-Bruce is back again with more Twitter political commentary  This time  he is advising President Buhari to sell off all the country  8217 s presidential jets  and appoint a Minister for Common Sense  Read his tweets  We need a common sense revolution  Though I know its not practical  I almost wish  MBuhari would appoint a    8230  ', 'http://www.bellanaija.com/2015/06/22/ben-murray-bruce-advises-pres-buhari-to-sell-all-countrys-presidential-jets/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:06', '2015-06-22 11:15:06'),
(50, 'Basorge Tariah and Kate Henshaw return to Television as Do-Good premieres', '', NULL, 'Comic great and renowned Nollywood actor  Basorge Tariah Jnr  is returning to the small screen as Africa Magic premieres its new Pidgin English sitcom  Do-good  on Monday  6 July  2015  Do-good  which is a spin-off of a popular Nigerian drama series of the 1990s  features the exploits of the titular character Do-good  played by Tariah     8230  ', 'Comic great and renowned Nollywood actor  Basorge Tariah Jnr  is returning to the small screen as Africa Magic premieres its new Pidgin English sitcom  Do-good  on Monday  6 July  2015  Do-good  which is a spin-off of a popular Nigerian drama series of the 1990s  features the exploits of the titular character Do-good  played by Tariah     8230  ', 'http://www.bellanaija.com/2015/06/22/basorge-tariah-and-kate-henshaw-return-to-television-as-do-good-premieres/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:06', '2015-06-22 11:15:06'),
(51, 'DJ Cuppy Releases “House of Cuppy II”! Features Olamide, P-Square, AKA & Others', '', NULL, 'DJ Cuppy is back with the second edition of her   8220 House of Cuppy  8221   compilation    8220 House of Cuppy II  8221  inspired by Africa  features songs from artistes including  Olamide  Seyi Shay  AKA  P-Square  Yemi Alade and the voice of actress   8211  Funke Akindele  Cuppy proves she can concoct a compilation with a rich and unique African tone  The tracks    8230  ', 'DJ Cuppy is back with the second edition of her   8220 House of Cuppy  8221   compilation    8220 House of Cuppy II  8221  inspired by Africa  features songs from artistes including  Olamide  Seyi Shay  AKA  P-Square  Yemi Alade and the voice of actress   8211  Funke Akindele  Cuppy proves she can concoct a compilation with a rich and unique African tone  The tracks    8230  ', 'http://www.bellanaija.com/2015/06/22/dj-cuppy-releases-house-of-cuppy-ii-features-olamide-p-square-aka-others/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:06', '2015-06-22 11:15:06'),
(52, 'Buhari Reportedly Planning to Appoint US-based Journalist Laolu Akande as Osinbajo’s Spokesperson', '', NULL, 'According to a Premium Times report  President Muhammadu Buhari is making plans to appoint US-based journalist  Laolu Akande  as a Senior Special Assistant to lead the media and communication unit in the office of Vice President Yemi Osinbajo  Akande is said to have once served as North American Bureau Chief of The Guardian  Sources say    8230  ', 'According to a Premium Times report  President Muhammadu Buhari is making plans to appoint US-based journalist  Laolu Akande  as a Senior Special Assistant to lead the media and communication unit in the office of Vice President Yemi Osinbajo  Akande is said to have once served as North American Bureau Chief of The Guardian  Sources say    8230  ', 'http://www.bellanaija.com/2015/06/22/buhari-reportedly-planning-to-appoint-us-based-journalist-laolu-akande-as-osinbajos-spokesperson/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:07', '2015-06-22 11:15:07'),
(53, 'Designer, Yusuf Abubakar Unveiled as the Creative Director for Bobby Valentino’s Clothing Line – ‘The Bobby V Collection’', '', NULL, 'Congratulations are in order for the new Creative Director of American singer  Bobby Valentino  8216 s clothing line   8211  The Bobby V Collection  Nigerian  fashion designer   8211  Yusuf Abubakar  The clothing line is yet to launch  but they are very excited about the partnership between Bobby and Yusuf  8217 s label    8211  Apparel Polo  Watch Bobby make the big announcement below     8230  ', 'Congratulations are in order for the new Creative Director of American singer  Bobby Valentino  8216 s clothing line   8211  The Bobby V Collection  Nigerian  fashion designer   8211  Yusuf Abubakar  The clothing line is yet to launch  but they are very excited about the partnership between Bobby and Yusuf  8217 s label    8211  Apparel Polo  Watch Bobby make the big announcement below     8230  ', 'http://www.bellanaija.com/2015/06/22/designer-yusuf-abubakar-unveiled-as-the-creative-director-for-bobby-valentinos-clothing-line-the-bobby-v-collection/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:07', '2015-06-22 11:15:07'),
(54, 'Nicole the Fertile Chick: I Married as a Virgin But I Can’t Conceive', '', NULL, 'This is one of the common statements I have heard amongst my friends and TTC community members  A good number of women who married as virgins  rather than getting knocked up immediately as expected  are still battling infertility many years later  Most times  this question is asked almost with a sense of entitlement  Like  they    8230  ', 'This is one of the common statements I have heard amongst my friends and TTC community members  A good number of women who married as virgins  rather than getting knocked up immediately as expected  are still battling infertility many years later  Most times  this question is asked almost with a sense of entitlement  Like  they    8230  ', 'http://www.bellanaija.com/2015/06/22/nicole-the-fertile-chick-i-married-as-a-virgin-but-i-cant-conceive/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:07', '2015-06-22 11:15:07'),
(55, 'BN Beauty: It’s a Purple Fiesta! Get CEO Dancer, Nqobilé Danseur’s Fun Look with Dayo Rasheeda of OTS Beauty', '', NULL, 'It  8217 s a very purple affair with CEO Dancer   8211  Nqobile Danseur  This is the third video from makeup artist Dayo Rasheeda of OTS Beauty  and along with making some of our favourite celebs like Tiwa Savage look   8216 bomb   she will be showing us how she got this stunning purple-themed look on Nqobile  Known to be    8230  ', 'It  8217 s a very purple affair with CEO Dancer   8211  Nqobile Danseur  This is the third video from makeup artist Dayo Rasheeda of OTS Beauty  and along with making some of our favourite celebs like Tiwa Savage look   8216 bomb   she will be showing us how she got this stunning purple-themed look on Nqobile  Known to be    8230  ', 'http://www.bellanaija.com/2015/06/22/bn-beauty-its-a-purple-fiesta-get-ceo-dancer-nqobile-danseurs-fun-look-with-dayo-rasheeda-of-ots-beauty/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:07', '2015-06-22 11:15:07'),
(56, 'Ex Rivers Gov. Amaechi Slams Wike’s Probe of His Administration | Says He Belongs in Nollywood', '', NULL, 'Former governor of Rivers State  Rotimi Amaechi  is unhappy with present governor Nyesom Wike  8216 s probe of his administration  Accusing Wike playing out a script full of lies  Amaechi recommended that Wike should employ his skills in Nollywood  This and more were contained in a statement released by the former governor   s media Office on Sunday  Read    8230  ', 'Former governor of Rivers State  Rotimi Amaechi  is unhappy with present governor Nyesom Wike  8216 s probe of his administration  Accusing Wike playing out a script full of lies  Amaechi recommended that Wike should employ his skills in Nollywood  This and more were contained in a statement released by the former governor   s media Office on Sunday  Read    8230  ', 'http://www.bellanaija.com/2015/06/22/ex-rivers-gov-amaechi-slams-wikes-probe-of-his-administration-says-he-belongs-in-nollywood/', 11, 11, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:07', '2015-06-22 11:15:07'),
(57, '''De Bruyne not yet world class'' - Moller', '<img alt="" src="http://static.goal.com/1492600/1492632_thumb.jpg" style="float: left;margin:0 10px 10px 10px;" title="" />', NULL, 'The retired German does not doubt the Belgium international s potential but he feels that the winger still has much to prove at the highest level', 'The retired German does not doubt the Belgium international s potential but he feels that the winger still has much to prove at the highest level', 'http://www.goal.com/en-ng/news/4076/germany/2015/06/22/12955022/de-bruyne-not-yet-world-class-moller', 13, 15, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:35', '2015-06-22 11:15:35'),
(58, 'What must the Buhari government do for Nigerian football?', '<img alt="Goodluck Jonathan & Muhammadu Buhari" src="http://static.goal.com/1182600/1182652_thumb.jpg" style="float: left;margin:0 10px 10px 10px;" title="Goodluck Jonathan & Muhammadu Buhari" />', NULL, 'How can the new administration in Nigeria best serve the Super Eagles and the national game as a whole ', 'How can the new administration in Nigeria best serve the Super Eagles and the national game as a whole ', 'http://www.goal.com/en-ng/news/4082/editorial/2015/06/22/12954902/what-must-the-buhari-government-do-for-nigerian-football', 13, 15, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:35', '2015-06-22 11:15:35'),
(59, 'Champions League & Europa League qualifying round draw LIVE', '<img alt="Lionel Messi Barcelona Champions League 06062015" src="http://static.goal.com/1492400/1492412_thumb.jpg" style="float: left;margin:0 10px 10px 10px;" title="Lionel Messi Barcelona Champions League 06062015" />', NULL, 'Celtic will learn their fate in the qualifying round draw for the Champions League  while West Ham are in the hat for the Europa League version of the draw', 'Celtic will learn their fate in the qualifying round draw for the Champions League  while West Ham are in the hat for the Europa League version of the draw', 'http://www.goal.com/en-ng/news/4074/champions-league/2015/06/22/12954502/champions-league-europa-league-qualifying-round-draw-live', 13, 15, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:36', '2015-06-22 11:15:36'),
(60, 'Peter Dedevbo invites 36 players for Liberia', '<img alt="Peter Dedevbo, Nigeria U-17 women coach" src="http://static.goal.com/212400/212451_thumb.jpg" style="float: left;margin:0 10px 10px 10px;" title="Peter Dedevbo, Nigeria U-17 women coach" />', NULL, 'The Falconets gaffer has invited thirty-six players to camp in preparation for the Fifa U20 Women   s World Cup qualifiers against Liberia', 'The Falconets gaffer has invited thirty-six players to camp in preparation for the Fifa U20 Women   s World Cup qualifiers against Liberia', 'http://www.goal.com/en-ng/news/4093/nigeria/2015/06/22/12949642/peter-dedevbo-invites-36-players-for-liberia', 13, 15, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:36', '2015-06-22 11:15:36'),
(61, 'Transfer Talk: AC Milan go all in on Cavani', '<img alt="HD Edinson Cavani Uruguay" src="http://static.goal.com/1553300/1553372_thumb.jpg" style="float: left;margin:0 10px 10px 10px;" title="HD Edinson Cavani Uruguay" />', NULL, 'The Rossoneri are willing to spend over    50 million on the Paris Saint-Germain striker as they desperately try to reinforce their attack', 'The Rossoneri are willing to spend over    50 million on the Paris Saint-Germain striker as they desperately try to reinforce their attack', 'http://www.goal.com/en-ng/news/4102/transfer-zone/2015/06/22/12954602/transfer-talk-ac-milan-go-all-in-on-cavani', 13, 15, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:36', '2015-06-22 11:15:36'),
(62, 'Neymar & Vidal stupidity can''t overshadow Copa America''s fine start', '<img alt="Charles Aranguiz, Jorge Valdivia Chile" src="http://static.goal.com/1560200/1560252_thumb.jpg" style="float: left;margin:0 10px 10px 10px;" title="Charles Aranguiz, Jorge Valdivia Chile" />', NULL, 'Both sides of South American football have been on show in Chile with controversy high on the agenda but not enough to distract from some electrifying football on the pitch', 'Both sides of South American football have been on show in Chile with controversy high on the agenda but not enough to distract from some electrifying football on the pitch', 'http://www.goal.com/en-ng/news/4082/editorial/2015/06/22/12955212/neymar-vidal-stupidity-cant-overshadow-copa-americas-fine', 13, 15, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:36', '2015-06-22 11:15:36'),
(63, 'Pirlo denies announcing Juventus exit for New York City FC', '<img alt="Tutta la delusione di Pirlo al fischio finale" src="http://static.goal.com/1490200/1490252_thumb.jpg" style="float: left;margin:0 10px 10px 10px;" title="Tutta la delusione di Pirlo al fischio finale" />', NULL, 'The veteran playmaker has pointed out that he could not have been responsible for the Instagram post as he does not have an account', 'The veteran playmaker has pointed out that he could not have been responsible for the Instagram post as he does not have an account', 'http://www.goal.com/en-ng/news/4102/transfer-zone/2015/06/22/12954072/pirlo-denies-announcing-juventus-exit-for-new-york-city-fc', 13, 15, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:36', '2015-06-22 11:15:36'),
(64, 'Neymar''s mistake hurt Brazil, laments Dani Alves', '<img alt="Tito Vilanova Funeral Neymar Dani Alves" src="http://static.goal.com/413600/413621_thumb.jpg" style="float: left;margin:0 10px 10px 10px;" title="Tito Vilanova Funeral Neymar Dani Alves" />', NULL, 'The striker must learn from his ban according to his older compatriot  though he still maintained the punishment was too severe', 'The striker must learn from his ban according to his older compatriot  though he still maintained the punishment was too severe', 'http://www.goal.com/en-ng/news/4055/main/2015/06/22/12953632/neymars-mistake-hurt-brazil-laments-dani-alves', 13, 15, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:36', '2015-06-22 11:15:36'),
(65, 'Video: Watch the highlights as Brazil see off Venezuela', '<img alt="Firmino traf zum zwischenzeitlichen 2:0" src="http://static.goal.com/1562300/1562382_thumb.jpg" style="float: left;margin:0 10px 10px 10px;" title="Firmino traf zum zwischenzeitlichen 2:0" />', NULL, 'Dunga s men endured some nervy moments but secured the win which saw them  Colombia and Peru advance to the quarter-finals', 'Dunga s men endured some nervy moments but secured the win which saw them  Colombia and Peru advance to the quarter-finals', 'http://www.goal.com/en-ng/news/4104/video/2015/06/22/12953432/video-watch-the-highlights-as-brazil-see-off-venezuela', 13, 15, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:36', '2015-06-22 11:15:36'),
(66, '''Monchengladbach could not compete with Real Madrid for Odegaard''', '<img alt="Real Madrid midfielder Martin Odegaard" src="http://static.goal.com/1562100/1562182_thumb.jpg" style="float: left;margin:0 10px 10px 10px;" title="Real Madrid midfielder Martin Odegaard" />', NULL, 'Die Foalen revealed they nearly landed the wonderkid in January before being pipped by the Spanish aristocrats', 'Die Foalen revealed they nearly landed the wonderkid in January before being pipped by the Spanish aristocrats', 'http://www.goal.com/en-ng/news/4102/transfer-zone/2015/06/22/12953262/monchengladbach-could-not-compete-with-real-madrid-for', 13, 15, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:36', '2015-06-22 11:15:36'),
(67, 'Sanvicente: Venezuela deserved better against Brazil', '<img alt="Venezuela se medirá ante Brasil por la tercera fecha del Grupo C." src="http://static.goal.com/1552800/1552812_thumb.jpg" style="float: left;margin:0 10px 10px 10px;" title="Venezuela se medirá ante Brasil por la tercera fecha del Grupo C." />', NULL, 'The 50-year-old has voiced his disappointment with the Vinotinto s unfortunate defeat in Santiago and their subsequent elimination', 'The 50-year-old has voiced his disappointment with the Vinotinto s unfortunate defeat in Santiago and their subsequent elimination', 'http://www.goal.com/en-ng/news/4055/main/2015/06/22/12952602/sanvicente-venezuela-deserved-better-against-brazil', 13, 15, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:36', '2015-06-22 11:15:36'),
(68, 'Paraguay can eliminate Brazil again, warns Thiago Silva', '<img alt="Thiago Silva Brazil 05062015" src="http://static.goal.com/1487500/1487562_thumb.jpg" style="float: left;margin:0 10px 10px 10px;" title="Thiago Silva Brazil 05062015" />', NULL, 'The Selecao will tackle the Albirroja again on Saturday - four years after they were upset by the same side at Argentina 2011', 'The Selecao will tackle the Albirroja again on Saturday - four years after they were upset by the same side at Argentina 2011', 'http://www.goal.com/en-ng/news/4055/main/2015/06/22/12951742/paraguay-can-eliminate-brazil-again-warns-thiago-silva', 13, 15, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:36', '2015-06-22 11:15:36'),
(69, 'Isco, Witsel, Oscar - who should Juventus sign this summer?', '<img alt="Juventus Transfer Poll" src="http://static.goal.com/1560500/1560582_thumb.jpg" style="float: left;margin:0 10px 10px 10px;" title="Juventus Transfer Poll" />', NULL, 'Ahead of the ransfer market officially re-opening on July 1  we ask readers who the Bianconeri   s top purchase should be for the 2015-16 campaign', 'Ahead of the ransfer market officially re-opening on July 1  we ask readers who the Bianconeri   s top purchase should be for the 2015-16 campaign', 'http://www.goal.com/en-ng/news/4102/transfer-zone/2015/06/22/12951602/isco-witsel-oscar-who-should-juventus-sign-this-summer', 13, 15, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:36', '2015-06-22 11:15:36'),
(70, 'Cech, Benzema, Sterling - who should Arsenal buy this summer?', '<img alt="Arsenal poll" src="http://static.goal.com/1562900/1562932_thumb.jpg" style="float: left;margin:0 10px 10px 10px;" title="Arsenal poll" />', NULL, 'The Gunners have been linked with a number of players as they look to build on their third-placed finish in the Premier League  but who should be Arsene Wenger s priority ', 'The Gunners have been linked with a number of players as they look to build on their third-placed finish in the Premier League  but who should be Arsene Wenger s priority ', 'http://www.goal.com/en-ng/news/4082/editorial/2015/06/22/12951672/cech-benzema-sterling-who-should-arsenal-buy-this-summer', 13, 15, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:36', '2015-06-22 11:15:36'),
(71, 'Real Madrid squad angered by medical upheaval', '<img alt="James Rodríguez analizó la eliminación del Real Madrid. " src="http://static.goal.com/1384500/1384592_thumb.jpg" style="float: left;margin:0 10px 10px 10px;" title="James Rodríguez analizó la eliminación del Real Madrid. " />', NULL, 'SPECIAL REPORT  The players are unhappy with staff changes this summer and many will treat their injuries outside the club next season', 'SPECIAL REPORT  The players are unhappy with staff changes this summer and many will treat their injuries outside the club next season', 'http://www.goal.com/en-ng/news/4082/editorial/2015/06/22/12951542/real-madrid-squad-angered-by-medical-upheaval', 13, 15, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-22 11:15:36', '2015-06-22 11:15:36');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  `active_fg` int(2) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_name`, `active_fg`, `created_date`, `modified_date`) VALUES
(1, 'ACTIVE', 1, '2015-06-18 10:30:23', '2015-06-18 10:30:23'),
(2, 'INACTIVE', 1, '2015-06-18 10:30:23', '2015-06-18 10:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image_url` text NOT NULL,
  `video_url` text,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `pub_id` int(11) NOT NULL,
  `feed_id` int(11) NOT NULL,
  `category_id` int(5) NOT NULL,
  `status_id` int(5) NOT NULL DEFAULT '1',
  `pub_date` datetime NOT NULL,
  `insert_date` datetime NOT NULL,
  `has_cluster` int(11) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_story_status_id` (`status_id`),
  KEY `fk_story_category` (`category_id`),
  KEY `fk_story_feed` (`feed_id`),
  KEY `fk_story_publisher` (`pub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `timeline_stories`
--

CREATE TABLE IF NOT EXISTS `timeline_stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` text NOT NULL,
  `video_url` text,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `url` text NOT NULL,
  `pub_id` int(11) NOT NULL,
  `category_id` int(5) NOT NULL,
  `status_id` int(5) NOT NULL DEFAULT '1',
  `pub_date` datetime NOT NULL,
  `insert_date` datetime NOT NULL,
  `has_cluster` int(11) NOT NULL DEFAULT '0',
  `reads` int(11) DEFAULT NULL,
  `link_outs` int(11) DEFAULT NULL,
  `shares` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_timeline_story_category` (`category_id`),
  KEY `fk_timeline_story_status` (`status_id`),
  KEY `fk_timeline_story` (`story_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trackings`
--

CREATE TABLE IF NOT EXISTS `trackings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `read_count` int(11) NOT NULL DEFAULT '0',
  `link_out_count` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tracking_user` (`user_id`),
  KEY `fk_tracking_story` (`story_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` int(11) NOT NULL,
  `email_address` int(11) NOT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `user_type` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_type` (`user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clusters`
--
ALTER TABLE `clusters`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_cluster_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_story_pivot` FOREIGN KEY (`cluster_pivot`) REFERENCES `stories` (`id`);

--
-- Constraints for table `feeds`
--
ALTER TABLE `feeds`
  ADD CONSTRAINT `fk_feed_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_feed_publisher` FOREIGN KEY (`pub_id`) REFERENCES `publishers` (`id`),
  ADD CONSTRAINT `fk_feed_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `fk_story_status_id` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_story_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_story_feed` FOREIGN KEY (`feed_id`) REFERENCES `feeds` (`id`),
  ADD CONSTRAINT `fk_story_publisher` FOREIGN KEY (`pub_id`) REFERENCES `publishers` (`id`);

--
-- Constraints for table `timeline_stories`
--
ALTER TABLE `timeline_stories`
  ADD CONSTRAINT `fk_timeline_story_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_timeline_story_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_timeline_story` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`);

--
-- Constraints for table `trackings`
--
ALTER TABLE `trackings`
  ADD CONSTRAINT `fk_tracking_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_tracking_story` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_type` FOREIGN KEY (`user_type`) REFERENCES `user_types` (`id`);