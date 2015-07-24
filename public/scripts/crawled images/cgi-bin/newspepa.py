#! /usr/bin/python


print "Content-type: text/html\n"

import cgitb; cgitb.enable()

from BeautifulSoup import BeautifulSoup
import MySQLdb
import nltk
#import feedparser
corpus = []
titles=[]
pivotids =[]

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

cur.execute("SELECT id,title,description,content,pub_id,category_id FROM stories")
for row in cur.fetchall() :
    words = nltk.wordpunct_tokenize(row[3])
    words.extend(nltk.wordpunct_tokenize(row[1]))
    lowerwords=[x.lower() for x in words if len(x) > 1]
    ct += 1
    #print ct, "TITLE",row[1], lowerwords
    corpus.append(lowerwords)
    titles.append(str(row[0]))
   

    #print ct, "TITLE",titles

#########################################
# tf-idf implementation
# from http://timtrueman.com/a-quick-foray-into-linear-algebra-and-python-tf-idf/
#########################################
import math
from operator import itemgetter
def freq(word, document): return document.count(word)
def wordCount(document): return len(document)
def numDocsContaining(word,documentList):
  count = 0
  for document in documentList:
    if freq(word,document) > 0:
      count += 1
  return count
def tf(word, document): return (freq(word,document) / float(wordCount(document)))
def idf(word, documentList): return math.log(len(documentList) / numDocsContaining(word,documentList))
def tfidf(word, document, documentList): return (tf(word,document) * idf(word,documentList))

#########################################
# extract top keywords from each doc.
# This defines features of our common feature vector
#########################################
import operator
def top_keywords(n,doc,corpus):
    d = {}
    for word in set(doc):
        d[word] = tfidf(word,doc,corpus)
    sorted_d = sorted(d.iteritems(), key=operator.itemgetter(1))
    sorted_d.reverse()
    return [w[0] for w in sorted_d[:n]]   

key_word_list=set()
nkeywords=4
[[key_word_list.add(x) for x in top_keywords(nkeywords,doc,corpus)] for doc in corpus]
   
ct=-1
for doc in corpus:
   ct+=1
   #print ct,"KEYWORDS"," ".join(key_word_list)

#########################################
# turn each doc into a feature vector using TF-IDF score
#########################################
feature_vectors=[]
n=len(corpus)

for document in corpus:
    vec=[]
    [vec.append(tfidf(word, document, corpus) if word in document else 0) for word in key_word_list]
    feature_vectors.append(vec)
    # print feature_vectors

#########################################
# now turn that into symmatrix matrix of 
# cosine similarities
#########################################
import numpy
mat = numpy.empty((n, n))
for i in xrange(0,n):
    for j in xrange(0,n):
       mat[i][j] = nltk.cluster.util.cosine_distance(feature_vectors[i],feature_vectors[j])




#########################################
# now hierarchically cluster mat
#########################################
from hcluster import linkage
t = 0.8
Z = linkage(mat, 'single')
#dendrogram(Z, color_threshold=t)

#import pylab
#pylab.savefig( "hcluster.png" ,dpi=800)

#########################################
# extract our clusters
#########################################
def extract_clusters(Z,threshold,n):
   clusters={}
   ct=n
   for row in Z:
      if row[2] < threshold:
          n1=int(row[0])
          n2=int(row[1])

          if n1 >= n:
             l1=clusters[n1] 
             del(clusters[n1]) 
          else:
             l1= [n1]
      
          if n2 >= n:
             l2=clusters[n2] 
             del(clusters[n2]) 
          else:
             l2= [n2]    
          l1.extend(l2)  
          clusters[ct] = l1
          ct += 1
      else:
          return clusters

clusters = extract_clusters(Z,t,n)
word =[]
dic={}
import time    
now =time.strftime('%Y-%m-%d %H:%M:%S')
print now
for key in clusters:
   #print "============================================="

   depths = [[titles[id]] for id in clusters[key]]
   b = [int(i[0]) for i in depths]
   d =b[0]
   dic[d] = b

matchfound=[]
total =map(int, titles)
 

for pivot in dic:
   for matches in dic[pivot]:
      matchfound.append(matches)
      #print pivot ,matches 
        #SQL query to INSERT a record into the table .
      cur.execute('''INSERT into clusters (cluster_pivot,cluster_match,status_id,created_date,modified_date)
                   values (%s,%s,%s,%s,%s)''',
                   (pivot,matches,statusid,now,now))
      cur.execute (""" UPDATE stories SET has_cluster=%s, status_id=%s """, (havecluster, statusid))
    # Commit your changes in the database
      db.commit()


"""uses list1 as the reference, returns list of items not in list2"""
matchfound = map(int, matchfound)
for item in total:
  
   if not item in matchfound:
    #SQL query to INSERT a record into the table .
        cur.execute('''INSERT into clusters (cluster_pivot,cluster_match,status_id,created_date,modified_date)
                   values (%s,%s,%s,%s,%s)''',
                   (item,item,statusid,now,now))
    
        cur.execute (""" UPDATE stories SET has_cluster=%s, status_id=%s """, (havecluster, statusid))
    # Commit your changes in the database
        db.commit()


print 'succesful'
# disconnect from server
db.close()  

       
       