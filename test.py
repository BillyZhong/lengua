import subprocess


cmd = "python pdf2txt.py -o biotestglossary.txt biotextglossary.pdf"
# no block, it start a sub process.
p = subprocess.Popen(cmd , shell=True, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
# and you can block util the cmd execute finish
p.wait()
# or stdout, stderr = p.communicate()


keywords = []
pagenumbers = []

with open('keywords.txt', 'r') as f:
    data = f.readlines()

    for line in data:
        words = line.split()
        keywords.append(words)
with open('biotestglossary.txt', 'r') as f:
    data = f.readlines()
    for line in data:
        words = line.split()
        if words:
            for keyword in keywords:
                if keyword[0] in words[0]:
                    leng = len(words)
                    pagenum = words[leng-1]
                    if pagenum.isdigit():
                        pagenumbers.append((""+keyword[0]+","+pagenum))
with open('pagenumbers.txt','w') as f:
    for page in pagenumbers:
        f.write(page+"\n")
