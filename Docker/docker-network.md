# Network

## Docker Network

### List Networks

```bash
docker network ls
```

### create network

```bash
docker network create my-network
```

### inspect network

```bash
docker network inspect my-network
```

### remove network

```bash
docker network rm my-network
```

### run container with network

```bash
docker run --rm -it --name my-container nicolaka/netshoot /bin/bash
```

### connect container to network

```bash
docker network connect my-network my-container
```
