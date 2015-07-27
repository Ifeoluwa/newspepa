__author__ = 'iconwaymedia'

import difflib
import sys
import json


def similar(seq1, seq2):
    return difflib.SequenceMatcher(a=seq1.lower(), b=seq2.lower()).ratio() > 0.9

try:
    data = json.loads(sys.argv[1])
    result = similar(data[0], data[1])
except:
    print ("ERROR")
    sys.exit(1)

# Send it to stdout (to PHP)
print(json.dumps(result))