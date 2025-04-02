import requests
from bs4 import BeautifulSoup
import pandas as pd

# Função para obter o email de um deputado
def get_email(deputado_id):
    print(f"Obtendo email do deputado com ID: {deputado_id}")
    url = f'https://scrivi.camera.it/scrivi?dest=deputato&id_aul={deputado_id}'
    response = requests.get(url)
    
    print(f"Requisição para o email retornou status {response.status_code}")
    
    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'html.parser')
        
        # Encontrar o email do deputado
        email_div = soup.find('div', class_='panel-heading')
        if email_div:
            email = email_div.find('h3').get_text(strip=True)
            # Extrair apenas o email da string
            email = email.split('(')[-1].replace(')', '')
            print(f"Email encontrado: {email}")
            return email
        else:
            print("Email não encontrado para esse deputado.")
    else:
        print("Erro ao acessar a página do email.")
    return None

# Função para fazer scraping de uma página de deputados
def get_deputados_da_pagina(page_num):
    print(f"Acessando a página {page_num}")
    url = f'https://www.camera.it/leg19/313?current_page_2632={page_num}'
    response = requests.get(url)

    # Verificar se a requisição foi bem-sucedida
    print(f"Requisição para a página {page_num} retornou status {response.status_code}")
    
    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'html.parser')

        # Encontrar a lista de deputados dentro da div com a classe 'main_img_ul'
        deputados = soup.find('ul', class_='main_img_ul')
        
        if not deputados:
            print(f"Não foi encontrada a lista de deputados na página {page_num}.")
            return []

        deputados = deputados.find_all('li')
        dados_deputados = []

        print(f"Encontrados {len(deputados)} deputados na página {page_num}")

        for deputado in deputados:
            # Nome do deputado
            nome = deputado.find('div', class_='nome_cognome_notorieta').find('a').get_text(strip=True)
            # Partido do deputado
            partido = deputado.find('div', class_='link_gruppo').find('a').get_text(strip=True)

            # ID do deputado para acessar o email
            link_email_div = deputado.find('div', class_='email')
            email = None
            
            if link_email_div:
                link_email = link_email_div.find('a')['href']
                deputado_id = link_email.split('id_aul=')[-1]
                
                print(f"Processando deputado: {nome}, Partido: {partido}, ID: {deputado_id}")
                
                # Obter o email do deputado
                email = get_email(deputado_id)

            # Adicionar os dados ao array de dados_deputados
            dados_deputados.append([nome, partido, email])

        return dados_deputados
    else:
        print(f"Erro ao acessar a página {page_num}: {response.status_code}")
        return []

# Lista para armazenar todos os dados
todos_deputados = []

# Loop para percorrer todas as 14 páginas
for page_num in range(1, 15):
    print(f"\nIniciando a coleta de dados da Página {page_num}")
    deputados = get_deputados_da_pagina(page_num)
    
    if deputados:
        print(f"Adicionando {len(deputados)} deputados à lista total.")
        todos_deputados.extend(deputados)
    print('-' * 40)

# Verificar se coletamos dados
if todos_deputados:
    print("\nDados coletados com sucesso. Exportando para Excel...")
    
    # Criar um DataFrame com os dados
    df = pd.DataFrame(todos_deputados, columns=['Nome', 'Partido', 'Email'])

    # Exportar os dados para um arquivo Excel
    df.to_excel('deputados.xlsx', index=False)

    print("Exportação para Excel concluída com sucesso!")
else:
    print("Nenhum dado de deputado foi coletado.")
