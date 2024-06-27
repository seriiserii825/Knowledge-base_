module completions {

  # Yazi command-line interface
  export extern ya [
    --help(-h)                # Print help
    --version(-V)             # Print version
  ]

  # Publish a message to remote instance(s)
  export extern "ya pub" [
    receiver: string          # The receiver ID
    kind: string              # The kind of message
    --str: string             # Send the message with a string body
    --json: string            # Send the message with a JSON body
    --help(-h)                # Print help
    --version(-V)             # Print version
  ]

  # Publish a static message to all remote instances
  export extern "ya pub-static" [
    severity: string          # The severity of the message
    kind: string              # The kind of message
    --str: string             # Send the message with a string body
    --json: string            # Send the message with a JSON body
    --help(-h)                # Print help
    --version(-V)             # Print version
  ]

  # Print this message or the help of the given subcommand(s)
  export extern "ya help" [
  ]

  # Publish a message to remote instance(s)
  export extern "ya help pub" [
  ]

  # Publish a static message to all remote instances
  export extern "ya help pub-static" [
  ]

  # Print this message or the help of the given subcommand(s)
  export extern "ya help help" [
  ]

}

export use completions *
