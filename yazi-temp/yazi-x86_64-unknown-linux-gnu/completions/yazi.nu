module completions {

  export extern yazi [
    entry?: string            # Set the current working entry
    --cwd-file: string        # Write the cwd on exit to this file
    --chooser-file: string    # Write the selected files to this file on open fired
    --clear-cache             # Clear the cache directory
    --local-events: string    # Report the specified local events to stdout
    --remote-events: string   # Report the specified remote events to stdout
    --debug                   # Print debug information
    --version(-V)             # Print version
    --help(-h)                # Print help
  ]

}

export use completions *
