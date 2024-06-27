
use builtin;
use str;

set edit:completion:arg-completer[ya] = {|@words|
    fn spaces {|n|
        builtin:repeat $n ' ' | str:join ''
    }
    fn cand {|text desc|
        edit:complex-candidate $text &display=$text' '(spaces (- 14 (wcswidth $text)))$desc
    }
    var command = 'ya'
    for word $words[1..-1] {
        if (str:has-prefix $word '-') {
            break
        }
        set command = $command';'$word
    }
    var completions = [
        &'ya'= {
            cand -h 'Print help'
            cand --help 'Print help'
            cand -V 'Print version'
            cand --version 'Print version'
            cand pub 'Publish a message to remote instance(s)'
            cand pub-static 'Publish a static message to all remote instances'
            cand help 'Print this message or the help of the given subcommand(s)'
        }
        &'ya;pub'= {
            cand --str 'Send the message with a string body'
            cand --json 'Send the message with a JSON body'
            cand -h 'Print help'
            cand --help 'Print help'
            cand -V 'Print version'
            cand --version 'Print version'
        }
        &'ya;pub-static'= {
            cand --str 'Send the message with a string body'
            cand --json 'Send the message with a JSON body'
            cand -h 'Print help'
            cand --help 'Print help'
            cand -V 'Print version'
            cand --version 'Print version'
        }
        &'ya;help'= {
            cand pub 'Publish a message to remote instance(s)'
            cand pub-static 'Publish a static message to all remote instances'
            cand help 'Print this message or the help of the given subcommand(s)'
        }
        &'ya;help;pub'= {
        }
        &'ya;help;pub-static'= {
        }
        &'ya;help;help'= {
        }
    ]
    $completions[$command]
}
