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
