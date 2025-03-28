import pandas as pd

df = pd.read_excel('notas.xlsx')

df['Média'] = (df['Nota1'] + df['Nota2'] + df['Nota3']) / 3

df.to_excel('ProvaAlunoxxx.xlsx', index=False)