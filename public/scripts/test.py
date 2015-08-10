__author__ = 'iconwaymedia'

import difflib
import sys
import json


def similar(seq1, seq2):
    # return seq1 + seq2 + data[2]
    return difflib.SequenceMatcher(a=seq1.lower(), b=seq2.lower()).ratio() > 0.7

try:
    clustered = []
    data = json.loads(sys.argv[1])
    old_stories = data[0]
    new_stories = data[1]

    for new in new_stories:
        for old in old_stories:
            result = similar(new['title'], old['title'])
            result2 = similar(new['description'], old['description'])
            result3 = result and result2
            if result3:
                new['pivot_id'] = old['id']
                break
            else:
                new['pivot_id'] = new['id'];

        clustered.append(new)

    print clustered


    # result = similar(data[0], data[1])
except:
    print ("ERROR")
    sys.exit(1)

# Send it to stdout (to PHP)
print(json.dumps(clustered))