This method retains **all commits, branches, tags, etc.**

#### 1\. **Clone the existing repo from Account A**

bash

CopyEdit

`git clone --mirror https://bitbucket.org/accountA/repo-name.git cd repo-name.git`
`git clone --mirror git@bitbucket.org:bludelego/rewind_ios.git`

- Use `--mirror` to clone everything: branches, tags, and all refs.
    

#### 2\. **Create a new empty repo on Account B**

- Go to Account B's Bitbucket dashboard.
    
- Create a new repository with the **same name or a new one**.
    
- **Do not initialize it with a README or .gitignore.**
    

#### 3\. **Push the mirror to Account B**

bash

CopyEdit

`git push --mirror https://bitbucket.org/blueline2025/rewind_ios.git`
git push --mirror git@bitbucket.org:blueline-ios/rewind-ios.git
git clone git@bitbucket.org:blueline-ios/rewind-ios.git
git push --mirror https://bludelego@bitbucket.org/blueline-ios/rewind-ios.git

#### 4\. **Done!**

Now the new repo under Account B has all commits, branches, and tags.

Blue2023Delego20!!!!

Blue2023Delego20!!!!
