# NestJS — Все встроенные HTTP Exception классы

### самые популярные

- BadRequestException (400) - неправильные данные запроса
- UnauthorizedException (401) - требуется аутентификация
- ForbiddenException (403) - нет прав доступа
- NotFoundException (404) - ресурс не найден
- ConflictException (409) - конфликт данных (дубликат)
- InternalServerErrorException (500) - внутренняя ошибка сервера

| Exception Class                           | HTTP Code | Description                          | Example                                              |
| ----------------------------------------- | --------- | ------------------------------------ | ---------------------------------------------------- |
| **HttpException**                         | custom    | Base exception                       | `throw new HttpException('Message', 400)`            |
| **MovedPermanentlyException**             | 301       | Permanent redirect                   | `throw new MovedPermanentlyException('/new')`        |
| **FoundException**                        | 302       | Temporary redirect                   | `throw new FoundException('/temp')`                  |
| **SeeOtherException**                     | 303       | Redirect after POST                  | `throw new SeeOtherException('/done')`               |
| **NotModifiedException**                  | 304       | Content not changed                  | `throw new NotModifiedException()`                   |
| **TemporaryRedirectException**            | 307       | Temporary redirect (same method)     | `throw new TemporaryRedirectException('/new')`       |
| **PermanentRedirectException**            | 308       | Permanent redirect (same method)     | `throw new PermanentRedirectException('/new')`       |
| **BadRequestException**                   | 400       | Invalid request data                 | `throw new BadRequestException('Invalid')`           |
| **UnauthorizedException**                 | 401       | Authentication required              | `throw new UnauthorizedException()`                  |
| **PaymentRequiredException**              | 402       | Reserved HTTP status                 | `throw new PaymentRequiredException()`               |
| **ForbiddenException**                    | 403       | No access rights                     | `throw new ForbiddenException()`                     |
| **NotFoundException**                     | 404       | Entity not found                     | `throw new NotFoundException('User not found')`      |
| **MethodNotAllowedException**             | 405       | HTTP method not allowed              | `throw new MethodNotAllowedException()`              |
| **NotAcceptableException**                | 406       | Cannot produce acceptable response   | `throw new NotAcceptableException()`                 |
| **ProxyAuthenticationRequiredException**  | 407       | Proxy needs authentication           | `throw new ProxyAuthenticationRequiredException()`   |
| **RequestTimeoutException**               | 408       | Request took too long                | `throw new RequestTimeoutException()`                |
| **ConflictException**                     | 409       | Data conflict (duplicate)            | `throw new ConflictException('Already exists')`      |
| **GoneException**                         | 410       | Resource permanently removed         | `throw new GoneException()`                          |
| **LengthRequiredException**               | 411       | Missing Content-Length               | `throw new LengthRequiredException()`                |
| **PreconditionFailedException**           | 412       | Failed HTTP precondition             | `throw new PreconditionFailedException()`            |
| **PayloadTooLargeException**              | 413       | Body too large                       | `throw new PayloadTooLargeException()`               |
| **URITooLongException**                   | 414       | URL too long                         | `throw new URITooLongException()`                    |
| **UnsupportedMediaTypeException**         | 415       | Unsupported Content-Type             | `throw new UnsupportedMediaTypeException()`          |
| **RequestedRangeNotSatisfiableException** | 416       | Invalid Range header                 | `throw new RequestedRangeNotSatisfiableException()`  |
| **ExpectationFailedException**            | 417       | Failed Expect header                 | `throw new ExpectationFailedException()`             |
| **IAmATeapotException**                   | 418       | Fun Easter-egg status                | `throw new IAmATeapotException()`                    |
| **MisdirectedException**                  | 421       | Wrong host/server                    | `throw new MisdirectedException()`                   |
| **UnprocessableEntityException**          | 422       | Valid format, invalid business logic | `throw new UnprocessableEntityException()`           |
| **FailedDependencyException**             | 424       | Dependent request failed             | `throw new FailedDependencyException()`              |
| **PreconditionRequiredException**         | 428       | Preconditions required               | `throw new PreconditionRequiredException()`          |
| **TooManyRequestsException**              | 429       | Rate limiting                        | `throw new TooManyRequestsException()`               |
| **RequestHeaderFieldsTooLargeException**  | 431       | Headers too large                    | `throw new RequestHeaderFieldsTooLargeException()`   |
| **UnavailableForLegalReasonsException**   | 451       | Blocked legally                      | `throw new UnavailableForLegalReasonsException()`    |
| **InternalServerErrorException**          | 500       | Unexpected server error              | `throw new InternalServerErrorException()`           |
| **NotImplementedException**               | 501       | Endpoint not implemented             | `throw new NotImplementedException()`                |
| **BadGatewayException**                   | 502       | Invalid upstream response            | `throw new BadGatewayException()`                    |
| **ServiceUnavailableException**           | 503       | Temporary server down                | `throw new ServiceUnavailableException('Try later')` |
| **GatewayTimeoutException**               | 504       | Upstream timeout                     | `throw new GatewayTimeoutException()`                |
| **HTTPVersionNotSupportedException**      | 505       | Unsupported HTTP version             | `throw new HTTPVersionNotSupportedException()`       |

---

## NestJS Internal Exceptions (not HTTP)

RuntimeException
InvalidModuleException
InvalidClassException
UnknownDependenciesException
UnknownElementException
UnknownExportException
CircularDependencyException
InvalidMiddlewareException

