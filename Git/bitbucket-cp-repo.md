This method retains **all commits, branches, tags, etc.**

#### 1\. **Clone the existing repo from Account A**

bash

CopyEdit

`git clone --mirror https://bitbucket.org/accountA/repo-name.git cd repo-name.git`

- Use `--mirror` to clone everything: branches, tags, and all refs.
    

#### 2\. **Create a new empty repo on Account B**

- Go to Account B's Bitbucket dashboard.
    
- Create a new repository with the **same name or a new one**.
    
- **Do not initialize it with a README or .gitignore.**
    

#### 3\. **Push the mirror to Account B**

bash

CopyEdit

`git push --mirror https://bitbucket.org/accountB/new-repo-name.git`

#### 4\. **Done!**

Now the new repo under Account B has all commits, branches, and tags.
