import json
import pandas as pd
import yfinance as yf

# Gets the historical stock information for a single stock, or a list of stocks
def getStockInfo(t):
    data = yf.download(t, start='2020-01-10', end='2020-12-26', group_by='ticker')
    data.head()
    return data.info

# Gets the financial statement
def getStockFundamentals(tickObj):
    # Empty list for holding result data
    dfs = []
    for ticker in tickerObj:
        # Get Each Tickers Financial Statement
        pnl = ticker.financials
        bs = ticker.balancesheet
        cf = ticker.cashflow

        # concatenate into one dataframe
        fs = pd.concat([pnl, bs, cf])

        # make dataframe format nicer
        # Swap dates and columns
        data = fs.T

        # reset index (date) into a column
        data = data.reset_index()

        # Rename old index from '' to Date
        data.columns = ['Date', *data.columns[1:]]

        # Add ticker to dataframe
        data['Ticker'] = ticker.ticker
        dfs.append(data)
    return dfs


def lambda_handler(event, context):
    # List of tickers. These would be allocated by the user during actual use
    t = ['GOOG', 'META']

    # Places the tickers into designated objects
    tickerObj = [yf.Ticker(ticker) for ticker in t]

    # Sets the resulting dataframes from the ticker into a variable (Then Prints)
    dataFrames = getStockFundamentals(tickerObj)

    body = {
        "message": "Stock Fundamentals",
        "data": dataFrames,
        "input": event,
    }
    response = {
        "statusCode": 200,
        "body": json.dumps(body),
    }
