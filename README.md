# 📝 Sistema de Gerenciamento de Chamados (Backend 2 - UTFPR)

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

Projeto desenvolvido para a disciplina de Backend 2 do curso de Sistemas para Internet da UTFPR, consistindo em um sistema completo de gerenciamento de chamados/tickets com autenticação de usuários e múltiplos níveis de acesso.

## ✨ Funcionalidades Principais

- **Autenticação de usuários** com três perfis:
  - 👨‍💼 Clientes (abrem e acompanham chamados)
  - 👩‍💻 Analistas (atendem e resolvem chamados)
  - 👑 Administradores (gerenciam todo o sistema)
  
- **Fluxo completo de chamados**:
  - Abertura, atribuição, acompanhamento e resolução
  - Categorização por departamento e nível de urgência
  - Sistema de comentários públicos/privados

- **API RESTful** para integração com outros sistemas

- **Relatórios e estatísticas** de desempenho

## 🛠️ Tecnologias Utilizadas

- **Backend**:
  - PHP 8.x
  - Laravel 10.x
  - MySQL
  - Laravel Sanctum (Autenticação API)
  - Laravel Breeze

- **Frontend**:
  - Blade Templates
  - Tailwind CSS
  - Alpine.js (interatividade)

- **Ferramentas**:
  - Docker (ambiente de desenvolvimento)
  - Composer
  - Git

## 🚀 Como Executar o Projeto

### Pré-requisitos

- PHP 8.0+
- Composer
- MySQL 5.7+
- Node.js (para assets)

### Instalação

1. Clone o repositório:
```bash
git clone https://github.com/seu-usuario/sistema-chamados-utfpr.git
cd sistema-chamados-utfpr
```

2. Instale as dependências:
```bash
composer install
npm install
```

3. Configure o ambiente:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure o banco de dados no arquivo `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

5. Execute as migrações e seeds:
```bash
php artisan migrate --seed
```

6. Inicie o servidor:
```bash
php artisan serve
```
Em outro prompt execute também:
```bash
npm run dev
```

7. Acesse no navegador:
```
http://localhost:8000
```

### Credenciais de Teste

- **Administrador**:
  - Email: admin@utfpr.edu.br
  - Senha: password

- **Analista**:
  - Email: analista@utfpr.edu.br
  - Senha: password

- **Cliente**:
  - Email: cliente@utfpr.edu.br
  - Senha: password

## 📚 Documentação da API

A API pode ser acessada em `/api` e requer autenticação via token. Consulte a documentação completa em:

[Documentação da API](docs/api.md) (Gerada com Laravel API Documentation Generator)

Exemplo de autenticação:
```javascript
const response = await fetch('/api/login', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    email: 'cliente@utfpr.edu.br',
    password: 'password',
    device_name: 'web_app'
  })
});
```

## 🧩 Estrutura do Projeto

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/          # Controladores da API
│   │   ├── Analyst/      # Controladores do painel do analista
│   │   └── Client/       # Controladores do painel do cliente
│   └── Middleware/       # Middlewares customizados
config/                   # Configurações do sistema
database/
├── migrations/           # Migrações do banco de dados
├── seeders/              # Dados iniciais
public/                   # Assets públicos
resources/
├── js/                   # JavaScript do frontend
├── lang/                 # Localizações
└── views/
    ├── analyst/          # Views do painel do analista
    ├── client/           # Views do painel do cliente
    └── auth/             # Views de autenticação
routes/
├── api.php               # Rotas da API
├── web.php               # Rotas web
tests/                    # Testes automatizados
```


## 📄 Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para detalhes.

