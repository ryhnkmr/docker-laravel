# docker-laravel
##環境構築手順
0. 前提
  まずDockerをダウンロードする。
  Macの方：https://docs.docker.com/docker-for-mac/install
  Winの方：https://docs.docker.com/docker-for-windows/install
1. まず、このプロジェクトをGitKrakenでcloneする。
 URL: `https://github.com/ryohei0419/docker-laravel.git`
2. VSCodeでクローンしたプロジェクトを開く
3. VSCodeでターミナルを開く
4. プロジェクトのDockerイメージなどを作成
`docker-compose up -d --build`
5. コンテナに入る
`docker-compose exec app bash`
6. 入ったコンテナの中でコマンドを叩く
`composer install`
7. 入ったコンテナの中でコマンドを叩く
`cp .env.example .env`
8. ローカルホストで表示
`http://127.0.0.1:10080`
8でLaravelの最初の画面が表示されていれば無事完了
