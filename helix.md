sudo apt install cargo

Next, you clone the Helix repository:

git clone --recurse-submodules --shallow-submodules -j8 https://github.com/helix-editor/helix

Move to the cloned directory:

cd helix

And now use cargo to install Helix:

cargo install --path helix-term --features "embed_runtime"

One last step is to add the hx binary to the PATH variable so that you can run it from anywhere. This should be added to your bashrc or bash profile.

export PATH=”$HOME/.cargo/bin:$PATH”

Now that everything is set, you should be able to use the editor by typing hx in the termi
