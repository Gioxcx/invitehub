# Modelo de Banco de Dados

Este documento descreve a modelagem inicial do banco de dados da plataforma InviteHub, considerando o uso do pacote `spatie/laravel-permission` para controle de acesso.

---

## 1. users

Armazena os usuários da plataforma.

| Campo             | Tipo        | Descrição                                 |
|-------------------|-------------|------------------------------------------ |
| id                | bigint      | Identificador único                       |
| name              | string      | Nome do usuário                           |
| email             | string      | E-mail único                              |
| email_verified_at | timestamp   | Verificação de e-mail                     |
| password          | string      | Senha criptografada                       |
| remember_token    | string      | Token de sessão                           |
| created_at        | timestamp   | Data de criação                           |
| updated_at        | timestamp   | Data de atualização                       |

---

## 2. invites

Armazena os convites enviados para novos usuários.

| Campo        | Tipo        | Descrição                                     |
|--------------|------------|------------------------------------------------|
| id           | bigint     | Identificador único                            |
| email        | string     | E-mail do convidado                            |
| token        | string     | Token único de convite                         |
| status       | string     | Status do convite                              |
| role_name    | string     | Papel a ser atribuído ao usuário               |
| expires_at   | timestamp  | Data de expiração do convite                   |
| accepted_at  | timestamp  | Data de aceite do convite                      |
| created_at   | timestamp  | Data de criação                                |
| updated_at   | timestamp  | Data de atualização                            |

---

## 3. Controle de Acesso (Roles & Permissions)

O gerenciamento de papéis e permissões é realizado através do pacote:

- `spatie/laravel-permission`

As tabelas abaixo são criadas e gerenciadas automaticamente pelo pacote:

- roles
- permissions
- model_has_roles
- model_has_permissions
- role_has_permissions

Estas tabelas seguem a estrutura padrão definida pelo pacote e não são modeladas manualmente neste documento.

---

## 4. companies (opcional)

Permite organização de usuários por empresa ou equipe (multi-tenancy).

| Campo       | Tipo        | Descrição                      |
|-------------|-------------|--------------------------------|
| id          | bigint      | Identificador único            |
| name        | string      | Nome da empresa                |
| created_at  | timestamp   | Data de criação                |
| updated_at  | timestamp   | Data de atualização            |

---

## 🔗 Relacionamentos

- Um convite gera um usuário ao ser aceito
- Um usuário pode possuir um ou mais papéis (Spatie)
- Papéis definem permissões de acesso
- Convites atribuem papel ao usuário via `role_name`
- (Opcional) Usuários podem pertencer a uma empresa

---

## 🔐 Regras de Negócio

- O campo `token` em `invites` deve ser único
- Convites possuem data de expiração
- Convites só podem ser aceitos uma única vez
- Usuários só podem ser criados via convite
- O papel definido no convite deve existir no sistema
