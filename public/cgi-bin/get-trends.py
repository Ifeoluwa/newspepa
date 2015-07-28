#!/usr/bin/python
import cgitb; cgitb.enable()
import MySQLdb
import nltk
#import feedparser
corpus = []
titles=[]
pivotids =[]
keywords=[]

havecluster = 1
statusid = 3
ct = -1

db = MySQLdb.connect(host="localhost", # your host, usually localhost
                     user="newspep_news", # your username
                      passwd="news1234", # your password
                      db="newspep_newspepadb") # name of the data base

#create a Cursor object. It will let
#you execute all the queries you need
cur = db.cursor()


cur.execute("SELECT cluster_pivot FROM clusters group by cluster_pivot")
for row in cur.fetchall() :
    pivotids.append(row[0])
    pivotid = row[0]
    
    cur.execute("SELECT id,title,description,content FROM stories where id = %s", (str(pivotid),))
    for row1 in cur.fetchall() :   
        words = row1[3] + " " + row1[1]
        corpus.append(words)
        titles.append(str(row1[0]))



cur.execute("SELECT id,title,description,content FROM stories where status_id != %s", (str(statusid),))
for row2 in cur.fetchall() :   
    words = row2[3]  + " " + row2[1]
    ct += 1
    corpus.append(words)
    titles.append(str(row2[0]))

str = " ";
seq = (corpus); # This is sequence of strings.
newdoc = str.join( seq );

from topia.termextract import tag
from topia.termextract import extract
extractor = extract.TermExtractor()
tagger = tag.Tagger()
tagger.initialize()
tagger

keywords.append (sorted(extractor(newdoc)))

for keyword in keywords:
    print keyword


