# Dokumentasi API Forum

## Overview
Forum adalah fitur yang memungkinkan alumni, mahasiswa aktif, dan dosen untuk berbagi posting dengan konten berupa teks, gambar, atau video, serta memberikan komentar pada posting tersebut.

## Database Structure

### Tabel Posts
- **id**: Primary Key
- **user_id**: Foreign Key ke users table
- **content**: Text konten posting (nullable)
- **image**: Path/URL gambar (nullable)
- **video**: Path/URL video (nullable)
- **likes_count**: Jumlah likes pada post
- **comments_count**: Jumlah comments pada post
- **created_at, updated_at**: Timestamps

### Tabel Comments
- **id**: Primary Key
- **post_id**: Foreign Key ke posts table
- **user_id**: Foreign Key ke users table
- **content**: Text komentar
- **likes_count**: Jumlah likes pada komentar
- **created_at, updated_at**: Timestamps

### Tabel Post Likes (Pivot)
- **id**: Primary Key
- **post_id**: Foreign Key ke posts table
- **user_id**: Foreign Key ke users table
- **created_at, updated_at**: Timestamps
- **Unique constraint**: (post_id, user_id)

### Tabel Comment Likes (Pivot)
- **id**: Primary Key
- **comment_id**: Foreign Key ke comments table
- **user_id**: Foreign Key ke users table
- **created_at, updated_at**: Timestamps
- **Unique constraint**: (comment_id, user_id)

---

## API Endpoints

### 1. GET /api/posts
**Deskripsi**: Mendapatkan daftar semua posts dengan pagination

**Auth**: Tidak wajib

**Response**:
```json
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "user_id": 1,
                "content": "Ini adalah posting pertama saya",
                "image": "posts/images/path-to-image.jpg",
                "video": null,
                "likes_count": 5,
                "comments_count": 3,
                "created_at": "2025-12-10T10:00:00Z",
                "updated_at": "2025-12-10T10:00:00Z",
                "user": {
                    "id": 1,
                    "name": "John Doe",
                    "email": "john@example.com",
                    "role": "alumni",
                    "profile_picture": "path-to-pic.jpg"
                },
                "comments": [...]
            }
        ],
        "last_page": 10,
        "per_page": 10,
        "total": 100
    }
}
```

---

### 2. POST /api/posts
**Deskripsi**: Membuat posting baru

**Auth**: Required (auth:sanctum)

**Request Body** (form-data):
```
content: "Teks posting saya" (optional)
image: <file> (optional, max 5MB)
video: <file> (optional, max 50MB)
```

**Validasi**:
- Minimal harus ada content atau media (image/video)
- Image format: jpeg, png, jpg, gif (max 5MB)
- Video format: mp4, avi, mov (max 50MB)

**Response**:
```json
{
    "success": true,
    "message": "Post berhasil dibuat",
    "data": {
        "id": 100,
        "user_id": 1,
        "content": "Teks posting saya",
        "image": "posts/images/xyz.jpg",
        "video": null,
        "likes_count": 0,
        "comments_count": 0,
        "created_at": "2025-12-10T10:30:00Z",
        "updated_at": "2025-12-10T10:30:00Z",
        "user": {...}
    }
}
```

---

### 3. GET /api/posts/{id}
**Deskripsi**: Mendapatkan detail posting dengan semua komentar

**Auth**: Tidak wajib

**URL Parameter**: 
- `id`: Post ID

**Response**:
```json
{
    "success": true,
    "data": {
        "id": 1,
        "user_id": 1,
        "content": "Posting saya",
        "image": "posts/images/xyz.jpg",
        "video": null,
        "likes_count": 5,
        "comments_count": 2,
        "created_at": "2025-12-10T10:00:00Z",
        "updated_at": "2025-12-10T10:00:00Z",
        "user": {...},
        "comments": [
            {
                "id": 5,
                "post_id": 1,
                "user_id": 2,
                "content": "Komentar bagus!",
                "likes_count": 1,
                "created_at": "2025-12-10T10:15:00Z",
                "updated_at": "2025-12-10T10:15:00Z",
                "user": {...}
            }
        ]
    }
}
```

---

### 4. PUT /api/posts/{id}
**Deskripsi**: Update posting (hanya pemilik)

**Auth**: Required (auth:sanctum)

**URL Parameter**: 
- `id`: Post ID

**Request Body** (JSON):
```json
{
    "content": "Konten posting yang diperbarui"
}
```

**Response**:
```json
{
    "success": true,
    "message": "Post berhasil diperbarui",
    "data": {...}
}
```

**Error**:
- 403: User bukan pemilik post

---

### 5. DELETE /api/posts/{id}
**Deskripsi**: Menghapus posting (hanya pemilik)

**Auth**: Required (auth:sanctum)

**URL Parameter**: 
- `id`: Post ID

**Response**:
```json
{
    "success": true,
    "message": "Post berhasil dihapus"
}
```

**Error**:
- 403: User bukan pemilik post

---

### 6. POST /api/posts/{id}/like
**Deskripsi**: Like atau Unlike sebuah posting

**Auth**: Required (auth:sanctum)

**URL Parameter**: 
- `id`: Post ID

**Response**:
```json
{
    "success": true,
    "message": "Post di-like",
    "liked": true,
    "likes_count": 6
}
```

---

### 7. GET /api/posts/{postId}/comments
**Deskripsi**: Mendapatkan komentar pada posting tertentu dengan pagination

**Auth**: Tidak wajib

**URL Parameter**: 
- `postId`: Post ID

**Response**:
```json
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 5,
                "post_id": 1,
                "user_id": 2,
                "content": "Komentar pertama",
                "likes_count": 2,
                "created_at": "2025-12-10T10:15:00Z",
                "updated_at": "2025-12-10T10:15:00Z",
                "user": {
                    "id": 2,
                    "name": "Jane Smith",
                    "email": "jane@example.com",
                    "role": "mahasiswa",
                    "profile_picture": "path-to-pic.jpg"
                }
            }
        ],
        "last_page": 5,
        "per_page": 10,
        "total": 42
    }
}
```

---

### 8. POST /api/posts/{postId}/comments
**Deskripsi**: Membuat komentar pada posting

**Auth**: Required (auth:sanctum)

**URL Parameter**: 
- `postId`: Post ID

**Request Body** (JSON):
```json
{
    "content": "Ini adalah komentar saya yang bagus"
}
```

**Validasi**:
- `content`: Required, string, max 5000 karakter

**Response**:
```json
{
    "success": true,
    "message": "Komentar berhasil dibuat",
    "data": {
        "id": 50,
        "post_id": 1,
        "user_id": 3,
        "content": "Ini adalah komentar saya yang bagus",
        "likes_count": 0,
        "created_at": "2025-12-10T10:45:00Z",
        "updated_at": "2025-12-10T10:45:00Z",
        "user": {...}
    }
}
```

---

### 9. GET /api/comments/{id}
**Deskripsi**: Mendapatkan detail komentar

**Auth**: Tidak wajib

**URL Parameter**: 
- `id`: Comment ID

**Response**:
```json
{
    "success": true,
    "data": {
        "id": 5,
        "post_id": 1,
        "user_id": 2,
        "content": "Komentar ini",
        "likes_count": 2,
        "created_at": "2025-12-10T10:15:00Z",
        "updated_at": "2025-12-10T10:15:00Z",
        "user": {...},
        "post": {...}
    }
}
```

---

### 10. PUT /api/comments/{id}
**Deskripsi**: Update komentar (hanya pemilik)

**Auth**: Required (auth:sanctum)

**URL Parameter**: 
- `id`: Comment ID

**Request Body** (JSON):
```json
{
    "content": "Komentar yang sudah diperbarui"
}
```

**Response**:
```json
{
    "success": true,
    "message": "Komentar berhasil diperbarui",
    "data": {...}
}
```

---

### 11. DELETE /api/comments/{id}
**Deskripsi**: Menghapus komentar (pemilik komentar atau pemilik post)

**Auth**: Required (auth:sanctum)

**URL Parameter**: 
- `id`: Comment ID

**Response**:
```json
{
    "success": true,
    "message": "Komentar berhasil dihapus"
}
```

---

### 12. POST /api/comments/{id}/like
**Deskripsi**: Like atau Unlike sebuah komentar

**Auth**: Required (auth:sanctum)

**URL Parameter**: 
- `id`: Comment ID

**Response**:
```json
{
    "success": true,
    "message": "Komentar di-like",
    "liked": true,
    "likes_count": 3
}
```

---

## Error Handling

### Validasi Error (422)
```json
{
    "success": false,
    "message": "Validation error message",
    "errors": {
        "content": ["Field content is required"]
    }
}
```

### Not Found Error (404)
```json
{
    "success": false,
    "message": "Post not found"
}
```

### Unauthorized Error (403)
```json
{
    "success": false,
    "message": "Anda tidak memiliki izin untuk mengubah post ini"
}
```

### Authentication Error (401)
```json
{
    "message": "Unauthenticated."
}
```

---

## Models & Relationships

### Post Model
```php
// Relationships
$post->user()              // Pemilik post
$post->comments()          // Semua komentar
$post->likes()             // Users yang like post
```

### Comment Model
```php
// Relationships
$comment->post()           // Post yang dikomentar
$comment->user()           // Pemilik komentar
$comment->likes()          // Users yang like komentar
```

### User Model
```php
// Relationships
$user->posts()             // Posts yang dibuat user
$user->comments()          // Komentar yang dibuat user
$user->likedPosts()        // Posts yang di-like user
$user->likedComments()     // Komentar yang di-like user
```

---

## Usage Examples

### CURL Examples

**1. Get All Posts**
```bash
curl -X GET http://localhost:8000/api/posts
```

**2. Create Post with Image**
```bash
curl -X POST http://localhost:8000/api/posts \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -F "content=Hello everyone!" \
  -F "image=@/path/to/image.jpg"
```

**3. Add Comment**
```bash
curl -X POST http://localhost:8000/api/posts/1/comments \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"content": "Great post!"}'
```

**4. Like a Post**
```bash
curl -X POST http://localhost:8000/api/posts/1/like \
  -H "Authorization: Bearer YOUR_TOKEN"
```

---

## Features Summary

✅ Users dapat membuat posting dengan teks, gambar, atau video  
✅ Users dapat melihat semua posting (pagination)  
✅ Users dapat memberikan komentar pada posting  
✅ Users dapat like/unlike posting dan komentar  
✅ Users hanya dapat edit/delete posting mereka sendiri  
✅ Users dapat edit komentar mereka sendiri  
✅ Post owner dapat delete komentar di posting mereka  
✅ Automatic counter untuk likes dan comments  
✅ User info disertakan dalam setiap response  

---

## Next Steps

1. Buat frontend UI untuk forum menggunakan Vue.js atau React
2. Implement real-time notifications menggunakan Laravel Broadcasting
3. Tambahkan fitur trending posts, popular users
4. Implement search dan filter untuk posts
5. Tambahkan moderation features (report, block user)
