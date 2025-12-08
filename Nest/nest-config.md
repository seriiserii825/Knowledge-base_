### install

```bash
bun add @nestjs/config
```

### setup

```ts
// app.module.ts
import { ConfigModule } from "@nestjs/config";

@Module({
  imports: [
    ConfigModule.forRoot({
      isGlobal: true,
    }),
    PrismaModule,
    AuthModule,
    UserModule,
    BookmarkModule,
    PrismaModule,
  ],
  controllers: [AppController],
  providers: [AppService],
})
export class AppModule {}
```

### usage in auth service

```ts
// auth.service.ts

constructor(
  config: ConfigService,
) {}


const token = await this.jwt.signAsync(payload, {
  expiresIn: '15m',
  secret: this.config.get('JWT_SECRET'),
});
```
