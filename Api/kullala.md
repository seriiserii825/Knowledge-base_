### kemap

```vim
nnoremap <leader>rr :lua require('kulala').run()<CR>
nnoremap <leader>ri :lua require('kulala').inspect()<CR>
nnoremap <leader>rt :lua require('kulala').toggle_view()<CR>
nnoremap <leader>rp :lua require('kulala').jump_prev()<CR>
nnoremap <leader>rn :lua require('kulala').jump_next()<CR>
nnoremap <leader>rc :lua require('kulala').copy()<CR>
nnoremap <leader>rq :lua require('kulala').close()<CR>
nnoremap <leader>rb :lua require('kulala').scratchpad()<CR>

" Для выбора environment используйте telescope или встроенный UI
nnoremap <leader>rs :lua require('kulala').search()<CR>
```

### json-placeholder.http

@env dev - use dev environment

```http

# @env dev

### Get home
GET {{baseUrl}}

### Get all users
GET {{apiUrl}}/users
Authorization: Bearer {{token}}

### Get a user
GET {{baseUrl}}/user

```

### http-client.env.json

```json
{
  "dev": {
    "baseUrl": "http://localhost:3000",
    "apiUrl": "http://localhost:3000/api",
    "token": "dev-token-123"
  },
  "staging": {
    "baseUrl": "https://staging.example.com",
    "apiUrl": "https://staging.example.com/api",
    "token": "staging-token-456"
  },
  "prod": {
    "baseUrl": "https://api.example.com",
    "apiUrl": "https://api.example.com/api",
    "token": "prod-token-789"
  }
}
```
