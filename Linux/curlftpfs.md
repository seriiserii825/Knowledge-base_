# curlftpfs

## С помощью этого замечательного средства можно выполнить практически любую операцию с ftp-ресурсом.

## Для начала установим пакет:

$ sudo aptitude install curlftpfs

## Затем подмонтируем интересующий нас ftp-ресурс:

$ mkdir temp-ftpfs
$ curlftpfs ftp://$USER:$PASSWD@$HOST/ temp-ftpfs
$ cd temp-ftpfs
$ ls
$ find / -name '\*.txt'

Всё очень просто.

## А вот отномнтировать получится только с root'овыми правами:(Dont't work)

$ sudo umount curlftpfs#ftp://$USER:$PASSWD@$HOST/

## Отмонтировать можно так:

$ fusermount -u temp-ftpfs

PS: Вольный перевод, с некоторыми дополнениями, статьи с Debian Administration.
ЗЫ: На мой взгляд удобнее использовать sshfs, но если нет доступа по ssh тогда и вышеуказанный метод на что-нибудь да сгодится.
