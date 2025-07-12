# Intro

Потребности меняются со временем; следовательно, меняется и код. В начальном
курсе объектно-ориентированного программирования мы узнали, что классы
делятся на конкретные, содержащие подробности реализации (код),
и абстрактные, представляющие только концепции. Если клиентский класс зависит от
конкретных подробностей, то изменение этих подробностей может нарушить его
работоспособность. Чтобы изолировать воздействие этих подробностей на класс,
в систему вводятся интерфейсы и абстрактные классы.

Зависимости от конкретики создает проблемы при тестировании системы. Если
мы строим класс Portfolio, зависящий от внешнего API TokyoStockExchange для
вычисления текущей стоимости портфеля ценных бумаг, наши тестовые сценарии
начинают зависеть от ненадежного внешнего фактора. Трудно написать тест, если
вы получаете разные ответы каждые пять минут!

Вместо того чтобы проектировать Portfolio с прямой зависимостью
от TokyoStockExchange, мы создаем интерфейс StockExchange,
в котором объявляется один метод:

```java

public interface StockExchange {
 Money currentPrice(String symbol);
}
```

Класс TokyoStockExchange проектируется с расчетом на реализацию этого интерфейса.
При ссылке на StockExchange передается в аргументе конструктора
Portfolio:

```java
from abc import ABC, abstractmethod

class StockExchange(ABC):
    @abstractmethod
    def current_price(self, symbol: str) -> 'Money':
        pass

class Portfolio:
    def __init__(self, exchange: StockExchange):
        self.exchange = exchange
    # ...
```

Теперь наш тест может создать пригодную для тестирования реализацию
интерфейса StockExchange, эмулирующую реальный API TokyoStockExchange. Тестовая
реализация задает текущую стоимость каждого вида акций, используемых при
тестировании. Если тест демонстрирует приобретение пяти акций Microsoft, мы
кодируем тестовую реализацию так, чтобы для Microsoft всегда возвращалась
стоимость $100 за акцию. Тестовая реализация интерфейса StockExchange сводится
к простому поиску по таблице. После этого пишется тест,
который должен вернуть общую стоимость портфеля в $500:

```java
public class PortfolioTest {
 private FixedStockExchangeStub exchange;
 private Portfolio portfolio;
 @Before
 protected void setUp() throws Exception {
 exchange = new FixedStockExchangeStub();
 exchange.fix("MSFT", 100);
 portfolio = new Portfolio(exchange);
 }
 @Test
 public void GivenFiveMSFTTotalShouldBe500() throws Exception {
 portfolio.add(5, "MSFT");
 Assert.assertEquals(500, portfolio.value());
 }
}
```
