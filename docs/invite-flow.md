# Fluxo de Convite de Usuários

Este documento descreve o fluxo de convite por e-mail utilizado na plataforma InviteHub.

---

## 1. Criação do Convite

- Administrador informa o e-mail do usuário
- Define o papel (role)
- Sistema cria um registro de convite
- Gera um token único com data de expiração
- Enfileira o envio do e-mail

---

## 2. Envio do E-mail

- E-mail contém link com token
- Link aponta para a tela de aceite do convite
- Token é validado ao acessar o link

---

## 3. Aceite do Convite

- Usuário informa nome e senha
- Sistema valida:
  - token existente
  - token não expirado
  - convite não utilizado
- Cria o usuário
- Associa o papel definido no convite
- Invalida o convite

---

## 4. Primeiro Acesso

- Usuário é autenticado automaticamente
- Acesso liberado conforme papel

---

## 5. Regras de Segurança

- Token de uso único
- Token com expiração
- Convite não pode ser reutilizado
- Convite inválido retorna erro

