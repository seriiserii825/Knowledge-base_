
using namespace System.Management.Automation
using namespace System.Management.Automation.Language

Register-ArgumentCompleter -Native -CommandName 'ya' -ScriptBlock {
    param($wordToComplete, $commandAst, $cursorPosition)

    $commandElements = $commandAst.CommandElements
    $command = @(
        'ya'
        for ($i = 1; $i -lt $commandElements.Count; $i++) {
            $element = $commandElements[$i]
            if ($element -isnot [StringConstantExpressionAst] -or
                $element.StringConstantType -ne [StringConstantType]::BareWord -or
                $element.Value.StartsWith('-') -or
                $element.Value -eq $wordToComplete) {
                break
        }
        $element.Value
    }) -join ';'

    $completions = @(switch ($command) {
        'ya' {
            [CompletionResult]::new('-h', 'h', [CompletionResultType]::ParameterName, 'Print help')
            [CompletionResult]::new('--help', 'help', [CompletionResultType]::ParameterName, 'Print help')
            [CompletionResult]::new('-V', 'V ', [CompletionResultType]::ParameterName, 'Print version')
            [CompletionResult]::new('--version', 'version', [CompletionResultType]::ParameterName, 'Print version')
            [CompletionResult]::new('pub', 'pub', [CompletionResultType]::ParameterValue, 'Publish a message to remote instance(s)')
            [CompletionResult]::new('pub-static', 'pub-static', [CompletionResultType]::ParameterValue, 'Publish a static message to all remote instances')
            [CompletionResult]::new('help', 'help', [CompletionResultType]::ParameterValue, 'Print this message or the help of the given subcommand(s)')
            break
        }
        'ya;pub' {
            [CompletionResult]::new('--str', 'str', [CompletionResultType]::ParameterName, 'Send the message with a string body')
            [CompletionResult]::new('--json', 'json', [CompletionResultType]::ParameterName, 'Send the message with a JSON body')
            [CompletionResult]::new('-h', 'h', [CompletionResultType]::ParameterName, 'Print help')
            [CompletionResult]::new('--help', 'help', [CompletionResultType]::ParameterName, 'Print help')
            [CompletionResult]::new('-V', 'V ', [CompletionResultType]::ParameterName, 'Print version')
            [CompletionResult]::new('--version', 'version', [CompletionResultType]::ParameterName, 'Print version')
            break
        }
        'ya;pub-static' {
            [CompletionResult]::new('--str', 'str', [CompletionResultType]::ParameterName, 'Send the message with a string body')
            [CompletionResult]::new('--json', 'json', [CompletionResultType]::ParameterName, 'Send the message with a JSON body')
            [CompletionResult]::new('-h', 'h', [CompletionResultType]::ParameterName, 'Print help')
            [CompletionResult]::new('--help', 'help', [CompletionResultType]::ParameterName, 'Print help')
            [CompletionResult]::new('-V', 'V ', [CompletionResultType]::ParameterName, 'Print version')
            [CompletionResult]::new('--version', 'version', [CompletionResultType]::ParameterName, 'Print version')
            break
        }
        'ya;help' {
            [CompletionResult]::new('pub', 'pub', [CompletionResultType]::ParameterValue, 'Publish a message to remote instance(s)')
            [CompletionResult]::new('pub-static', 'pub-static', [CompletionResultType]::ParameterValue, 'Publish a static message to all remote instances')
            [CompletionResult]::new('help', 'help', [CompletionResultType]::ParameterValue, 'Print this message or the help of the given subcommand(s)')
            break
        }
        'ya;help;pub' {
            break
        }
        'ya;help;pub-static' {
            break
        }
        'ya;help;help' {
            break
        }
    })

    $completions.Where{ $_.CompletionText -like "$wordToComplete*" } |
        Sort-Object -Property ListItemText
}
