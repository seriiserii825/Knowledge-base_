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

Класс TokyoStockExchange проектируется с расчетом на реализацию этого интерфейса.
При ссылке на StockExchange передается в аргументе конструктора
Portfolio:

```java
from abc import ABC, abstractmethod
import unittest

# Interface (Abstract Base Class)
class StockExchange(ABC):
    @abstractmethod
    def current_price(self, symbol: str) -> float:
        pass

# Real implementation (Tokyo Stock Exchange simulator)
class TokyoStockExchange(StockExchange):
    def current_price(self, symbol: str) -> float:
        # Actual implementation would call real API
        raise NotImplementedError("Real API call not implemented for tests")

# Test stub implementation
class FixedStockExchangeStub(StockExchange):
    def __init__(self):
        self.prices = {}
    
    def fix(self, symbol: str, price: float):
        self.prices[symbol] = price
    
    def current_price(self, symbol: str) -> float:
        return self.prices.get(symbol, 0.0)

# Portfolio class
class Portfolio:
    def __init__(self, exchange: StockExchange):
        self.exchange = exchange
        self.holdings = {}
    
    def add(self, quantity: int, symbol: str):
        self.holdings[symbol] = self.holdings.get(symbol, 0) + quantity
    
    def value(self) -> float:
        total = 0.0
        for symbol, quantity in self.holdings.items():
            price = self.exchange.current_price(symbol)
            total += price * quantity
        return total

# Test case
class PortfolioTest(unittest.TestCase):
    def setUp(self):
        self.exchange = FixedStockExchangeStub()
        self.exchange.fix("MSFT", 100)
        self.portfolio = Portfolio(self.exchange)
    
    def test_given_five_msft_total_should_be_500(self):
        self.portfolio.add(5, "MSFT")
        self.assertEqual(500, self.portfolio.value())

if __name__ == '__main__':
    unittest.main()
```

Теперь наш тест может создать пригодную для тестирования реализацию
интерфейса StockExchange, эмулирующую реальный API TokyoStockExchange. Тестовая
реализация задает текущую стоимость каждого вида акций, используемых при
тестировании. Если тест демонстрирует приобретение пяти акций Microsoft, мы
кодируем тестовую реализацию так, чтобы для Microsoft всегда возвращалась
стоимость $100 за акцию. Тестовая реализация интерфейса StockExchange сводится
к простому поиску по таблице. После этого пишется тест,
который должен вернуть общую стоимость портфеля в $500:
