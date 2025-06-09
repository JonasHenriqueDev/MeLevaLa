# MeLevaLa - Backend Laravel

## Como rodar

### Pré-requisitos
- Docker instalado

### Passos

1. Clone este repositório
2. No terminal (ou Git Bash), rode:

```bash
docker compose up -d
docker exec melevala_app composer install
docker exec melevala_app php artisan key:generate
docker exec melevala_app php artisan migrate:fresh --seed
```

# Exemplos de Login de Usuários

Este arquivo contém exemplos de requisições JSON para login de usuários na API, utilizando o endpoint `/api/login` (ou outro definido no seu projeto).

---

## 🔐 Usuário Somente Motorista

Este usuário está cadastrado como motorista, mas **não é um passageiro**.

**JSON:**
```json
{
  "email": "joao.motorista@example.com",
  "password": "senha123"
}
```

---

## 🧍 Usuário Somente Passageiro

Este usuário está cadastrado como passageiro, mas **não é um motorista**.

**JSON:**
```json
{
  "email": "ana.passageira@example.com",
  "password": "senha123"
}
```

---

## 🚗🧍‍♂️ Usuário Motorista e Passageiro

Este usuário está cadastrado como **motorista e passageiro** ao mesmo tempo.

**JSON:**
```json
{
  "email": "carlos.dual@example.com",
  "password": "senha123"
}
```

---

## 🔁 Endpoint

As requisições devem ser enviadas para o endpoint de login da sua API, por exemplo:

```
POST /api/login
Content-Type: application/json
```

A resposta será um token de autenticação do tipo Bearer que poderá ser usado nos headers das próximas requisições autenticadas.

---



# 📘 Documentação Básica da API - MeLevaLa

## 🔐 Autenticação

### 🔸 Registrar novo usuário

**POST** `/api/auth/register`

**Body JSON:**

```json
{
  "name": "João Motorista",
  "email": "joao@example.com",
  "password": "senha123",
  "password_confirmation": "senha123",
  "is_motorista": true,
  "is_passageiro": false
}
```

### 🔸 Login

**POST** `/api/auth/login`

**Body JSON:**

```json
{
  "email": "joao@example.com",
  "password": "senha123"
}
```

**Resposta:**

```json
{
  "access_token": "seu_token_aqui",
  "token_type": "Bearer"
}
```

### 🔸 Logout

**POST** `/api/auth/logout`
**Header:** `Authorization: Bearer {token}`

---

## 👤 Usuários

### Listar usuários

**GET** `/api/users`

### Ver um usuário

**GET** `/api/users/{id}`

### Atualizar usuário

**PUT** `/api/users/{id}`

### Deletar usuário

**DELETE** `/api/users/{id}`

---

## 🚗 Motoristas

### Listar motoristas

**GET** `/api/motoristas`

### Criar motorista

**POST** `/api/motoristas`

**Body exemplo:**

```json
{
  "user_id": 1,
  "nome": "João Motorista",
  "avaliacao": 4.8
}
```

---

## 🧍 Passageiros

### Listar passageiros

**GET** `/api/passageiros`

### Criar passageiro

**POST** `/api/passageiros`

**Body exemplo:**

```json
{
  "user_id": 2,
  "nome": "Ana Passageira",
  "avaliacao": 4.9
}
```

---

## 🛣️ Viagens

### Listar viagens

**GET** `/api/viagens`

### Criar viagem

**POST** `/api/viagens`

**Body exemplo:**

```json
{
  "latitude_partida": -8.0623,
  "longitude_partida": -34.8711,
  "latitude_destino": -8.0476,
  "longitude_destino": -34.8770,
  "valor": 25.50,
  "data": "2025-06-09",
  "motorista_id": 1,
  "passageiro_id": 2
}
```

---

## ⚠️ Observações

- Todos os endpoints (exceto login e register) requerem autenticação via token.
- Adicione o header: `Authorization: Bearer {token}` para fazer requisições autenticadas.
- Respostas de erro e validação serão retornadas em JSON.
