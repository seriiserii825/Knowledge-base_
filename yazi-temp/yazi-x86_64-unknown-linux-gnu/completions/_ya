#compdef ya

autoload -U is-at-least

_ya() {
    typeset -A opt_args
    typeset -a _arguments_options
    local ret=1

    if is-at-least 5.2; then
        _arguments_options=(-s -S -C)
    else
        _arguments_options=(-s -C)
    fi

    local context curcontext="$curcontext" state line
    _arguments "${_arguments_options[@]}" \
'-h[Print help]' \
'--help[Print help]' \
'-V[Print version]' \
'--version[Print version]' \
":: :_ya_commands" \
"*::: :->ya" \
&& ret=0
    case $state in
    (ya)
        words=($line[1] "${words[@]}")
        (( CURRENT += 1 ))
        curcontext="${curcontext%:*:*}:ya-command-$line[1]:"
        case $line[1] in
            (pub)
_arguments "${_arguments_options[@]}" \
'--str=[Send the message with a string body]:STR: ' \
'--json=[Send the message with a JSON body]:JSON: ' \
'-h[Print help]' \
'--help[Print help]' \
'-V[Print version]' \
'--version[Print version]' \
':receiver -- The receiver ID:' \
':kind -- The kind of message:' \
&& ret=0
;;
(pub-static)
_arguments "${_arguments_options[@]}" \
'--str=[Send the message with a string body]:STR: ' \
'--json=[Send the message with a JSON body]:JSON: ' \
'-h[Print help]' \
'--help[Print help]' \
'-V[Print version]' \
'--version[Print version]' \
':severity -- The severity of the message:' \
':kind -- The kind of message:' \
&& ret=0
;;
(help)
_arguments "${_arguments_options[@]}" \
":: :_ya__help_commands" \
"*::: :->help" \
&& ret=0

    case $state in
    (help)
        words=($line[1] "${words[@]}")
        (( CURRENT += 1 ))
        curcontext="${curcontext%:*:*}:ya-help-command-$line[1]:"
        case $line[1] in
            (pub)
_arguments "${_arguments_options[@]}" \
&& ret=0
;;
(pub-static)
_arguments "${_arguments_options[@]}" \
&& ret=0
;;
(help)
_arguments "${_arguments_options[@]}" \
&& ret=0
;;
        esac
    ;;
esac
;;
        esac
    ;;
esac
}

(( $+functions[_ya_commands] )) ||
_ya_commands() {
    local commands; commands=(
'pub:Publish a message to remote instance(s)' \
'pub-static:Publish a static message to all remote instances' \
'help:Print this message or the help of the given subcommand(s)' \
    )
    _describe -t commands 'ya commands' commands "$@"
}
(( $+functions[_ya__help_commands] )) ||
_ya__help_commands() {
    local commands; commands=(
'pub:Publish a message to remote instance(s)' \
'pub-static:Publish a static message to all remote instances' \
'help:Print this message or the help of the given subcommand(s)' \
    )
    _describe -t commands 'ya help commands' commands "$@"
}
(( $+functions[_ya__help__help_commands] )) ||
_ya__help__help_commands() {
    local commands; commands=()
    _describe -t commands 'ya help help commands' commands "$@"
}
(( $+functions[_ya__help__pub_commands] )) ||
_ya__help__pub_commands() {
    local commands; commands=()
    _describe -t commands 'ya help pub commands' commands "$@"
}
(( $+functions[_ya__pub_commands] )) ||
_ya__pub_commands() {
    local commands; commands=()
    _describe -t commands 'ya pub commands' commands "$@"
}
(( $+functions[_ya__help__pub-static_commands] )) ||
_ya__help__pub-static_commands() {
    local commands; commands=()
    _describe -t commands 'ya help pub-static commands' commands "$@"
}
(( $+functions[_ya__pub-static_commands] )) ||
_ya__pub-static_commands() {
    local commands; commands=()
    _describe -t commands 'ya pub-static commands' commands "$@"
}

if [ "$funcstack[1]" = "_ya" ]; then
    _ya "$@"
else
    compdef _ya ya
fi
