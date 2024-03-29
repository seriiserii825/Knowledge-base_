## Install Onefetch

Execute the following command to download `tar.gz` file from releases page of the Onefetch repository:

```plaintext
sudo wget -qO onefetch.tar.gz https://github.com/o2sh/onefetch/releases/latest/download/onefetch-linux.tar.gz
```

Extract a `tar.gz file` to `/usr/local/bin` directory.

```plaintext
sudo tar xf onefetch.tar.gz -C /usr/local/bin
```

Now `onefetch` command will be available for all users.

We can check Onefetch version with command:

```plaintext
onefetch --version
```

Remove `tar.gz` file because no longer needed it:

```plaintext
rm -rf onefetch.tar.gz
```
