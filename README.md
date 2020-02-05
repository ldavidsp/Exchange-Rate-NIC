# Exchange Rate Dollar Nicaragua

## Installation

```
composer require ldavidsp/exchange-rate-ni-bank
```

### Central Bank Nicaragua:

Dollar Exchange Today
```
\NIBanks\banks\BCNicaragua::todayDollar();
```
Change of dollars of the month  ```Y/m```
```
\NIBanks\banks\BCNicaragua::monthDollar(2020, 2);
```

### BAC Credomatic:

Dollar Exchange
```
\NIBanks\banks\Credomatic::todayDollar();
```
Euro Exchange
```
\NIBanks\banks\Credomatic::todayEuro();
```
