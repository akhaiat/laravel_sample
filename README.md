# laravel_sample

# DEMO

![Laravel](https://user-images.githubusercontent.com/79038665/111024263-1a99b400-8421-11eb-92ee-f15559734717.png)



# Requirement

* Docker-compose 3.8
* nginx:1.18-alpine
* mysql:8.0
* php:7.4-fpm-buster
* Laravel Framework 8.32.1

# ディレクトリ構成

フォルダ構成のように作成
```bash
├── README.md
├── infra
│   ├── mysql
│   │   ├── Dockerfile
│   │   └── my.cnf
│   ├── nginx
│   │   └── default.conf
│   └── php
│       ├── Dockerfile
│       └── php.ini
├── docker-compose.yml
└── backend
```

# Installation

```bash
docker-compose up -d --build
```
Laravelのインストール
```bash
docker-compose exec app bash

composer create-project --prefer-dist "laravel/laravel=8.*" .
```

localhost:8080からLaravelのwelcomeページを確認


# Note

## mysqlコンテナ

### ファイルパーミッション

Windows環境でvolumeマウントを行うと、ファイルパーミッションがrwになってしまう。
my.cnfに書き込み権限がついているとMySQLの起動時にエラーが出てしまう。
infra/mysql/Dockerfileにて権限の変更をしている。

### DB_USERNAME,DB_PASSWORDの変更

変更前に一度コンテナを起動してしまうとデータベースの永続化がされているため一度ローカルのvolumeを削除する。

### 手順
```bash
docker-compose down
docker volume ls
dokcer volume rm (lsで表示されたvolume名　複数：スペース区切りで並べる)
```


# 参考
## 環境構築
https://qiita.com/ucan-lab/items/56c9dc3cf2e6762672f4#%E3%83%87%E3%83%BC%E3%82%BF%E3%83%99%E3%83%BC%E3%82%B9db%E3%82%B3%E3%83%B3%E3%83%86%E3%83%8A%E3%82%92%E4%BD%9C%E3%82%8B

## ページ作成
https://qiita.com/sano1202/items/6021856b70e4f8d3dc3d

## mysql起動の対応
https://qiita.com/fukusan0901/items/42d76eaf99bc9a383934
