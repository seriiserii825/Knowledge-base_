const completion: Fig.Spec = {
  name: "ya",
  description: "Yazi command-line interface",
  subcommands: [
    {
      name: "pub",
      description: "Publish a message to remote instance(s)",
      options: [
        {
          name: "--str",
          description: "Send the message with a string body",
          isRepeatable: true,
          args: {
            name: "str",
            isOptional: true,
          },
        },
        {
          name: "--json",
          description: "Send the message with a JSON body",
          isRepeatable: true,
          args: {
            name: "json",
            isOptional: true,
          },
        },
        {
          name: ["-h", "--help"],
          description: "Print help",
        },
        {
          name: ["-V", "--version"],
          description: "Print version",
        },
      ],
      args: [
        {
          name: "receiver",
        },
        {
          name: "kind",
        },
      ]
    },
    {
      name: "pub-static",
      description: "Publish a static message to all remote instances",
      options: [
        {
          name: "--str",
          description: "Send the message with a string body",
          isRepeatable: true,
          args: {
            name: "str",
            isOptional: true,
          },
        },
        {
          name: "--json",
          description: "Send the message with a JSON body",
          isRepeatable: true,
          args: {
            name: "json",
            isOptional: true,
          },
        },
        {
          name: ["-h", "--help"],
          description: "Print help",
        },
        {
          name: ["-V", "--version"],
          description: "Print version",
        },
      ],
      args: [
        {
          name: "severity",
        },
        {
          name: "kind",
        },
      ]
    },
    {
      name: "help",
      description: "Print this message or the help of the given subcommand(s)",
      subcommands: [
        {
          name: "pub",
          description: "Publish a message to remote instance(s)",
        },
        {
          name: "pub-static",
          description: "Publish a static message to all remote instances",
        },
        {
          name: "help",
          description: "Print this message or the help of the given subcommand(s)",
        },
      ],
    },
  ],
  options: [
    {
      name: ["-h", "--help"],
      description: "Print help",
    },
    {
      name: ["-V", "--version"],
      description: "Print version",
    },
  ],
};

export default completion;
