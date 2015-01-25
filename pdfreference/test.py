keywords = []
pagenumbers = []
with open('bioterms.txt', 'r') as f:
    data = f.readlines()

    for line in data:
        words = line.split()
        keywords.append(words)
with open('output.txt', 'r') as f:
    data = f.readlines()
    for line in data:
        words = line.split()
        if words:
        	for keyword in keywords:
        		if keyword[0] == words[0]:
        			leng = len(words)
        			pagenum = words[leng-1]
        			if pagenum.isdigit():
        				pagenumbers.append((""+keyword[0]+","+pagenum))
with open('pagenumbers.txt','w') as f:
	for page in pagenumbers:
		f.write(page+"\n")
