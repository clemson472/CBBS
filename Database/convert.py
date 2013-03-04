import sys


def addToMentorTable(oldarr, mentorfile):
	newarr = []
	newarr.append(oldarr[0])   #Email
	newarr.append(oldarr[1])   #First
	newarr.append(oldarr[2])   #Middle
	newarr.append(oldarr[3])   #Last
	newarr.append(oldarr[4])   #Work Phone
	newarr.append(oldarr[5])   #Work Phone Ext.
	newarr.append(oldarr[6])   #Mobile Phone
	newarr.append(" ")         #Street Address
	newarr.append(" ")         #City
	newarr.append(" ")         #State
	newarr.append(" ")         #Country
	newarr.append(" ")         #Zip
	newarr.append(oldarr[11])  #IsMentor
	newarr.append(oldarr[12])  #IsMentee
	newarr.append("FALSE")     #IsAdmin
	newarr.append(oldarr[14])  #IsSponsor
	newarr.append(oldarr[15])  #Years In Current Position
	newarr.append(oldarr[16])  #Years In Company
	newarr.append(" ")         #Company Name
	newarr.append(" ")         #Position
	newarr.append(oldarr[17])  #ShowInMatchResult
	newarr.append(oldarr[18])  #Title
	newarr.append(oldarr[20])  #Background

	lineout = ','.join(newarr)
	mentorfile.write(lineout)
	mentorfile.write('\n')


def addToMenteeTable(linearr, menteefile):
	#newarr = [" "] * 
	newarr = []
	newarr.append(oldarr[0])   #Email
	newarr.append(" ")         #University
	newarr.append(" ")         #Graduation Year
	newarr.append(" ")         #Major
	newarr.append(oldarr[1])   #First
	newarr.append(oldarr[2])   #Middle
	newarr.append(oldarr[3])   #Last
	newarr.append(oldarr[6])   #Mobile Phone
	newarr.append(" ")         #Street Address
	newarr.append(" ")         #City
	newarr.append(" ")         #State
	newarr.append(" ")         #Country
	newarr.append(" ")         #Zip
	newarr.append(oldarr[11])  #IsMentor
	newarr.append(oldarr[12])  #IsMentee
	newarr.append("FALSE")     #IsAdmin
	newarr.append(oldarr[17])  #ShowInMatchResult
	newarr.append(oldarr[20])  #Background

	lineout = ','.join(newarr)
	menteefile.write(lineout)
	menteefile.write('\n')


mentorfile = open("Mentor.csv", 'w')
menteefile = open("Mentee.csv", 'w')

while True:

	line = sys.stdin.readline()

	if not line:
		break

	#print line

	linearr = line.split(',')
	#print linearr #0 indexed

	if linearr[11] == "TRUE":
		addToMentorTable(linearr, mentorfile)

	if linearr[12] == "TRUE":
		addToMenteeTable(linearr, menteefile)

	lineout = ','.join(linearr)
	print lineout
