import sys
import httplib
import re

print sys.argv[1]
if sys.argv[2] == "null":
	c = httplib.HTTPConnection("www.scholar.google.com");
	print "Google Scholar"
elif sys.argv[2] == null:
	c = httplib.HTTPConnection("www.google.com");
	print "Google"

filename = sys.argv[1]
with open(filename,"r") as f:
	for words in f:
		print words
		c.request("GET", "/search?q=" + words)
		r1 = c.getresponse()
		data1 = r1.read()
		print data1
		