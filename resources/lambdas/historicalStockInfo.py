# import json
# import pandas as pd
# import numpy as np
#
#
# def getInfo(event, context):
#     # event['json'] should have all your shit in it
#
#     df = pd.read_json(event.data)
#
#     return {
#         'dataframe' : json.loads(df.to_json())
#     }


import numpy as np
import matplotlib as mpl
import matplotlib.pyplot as plt

def getInfo(event, context):
    return 'hello'
