class FileReadError(Exception):
    pass


def read_file(path):
    # Самая глубокая функция
    if not path.endswith(".txt"):
        raise FileReadError(f"Неверный формат файла: {path}")
    return "Файл успешно прочитан"


def load_config():
    # Средний уровень
    return read_file("config.json")  # ← выбросит исключение


def start_application():
    # Верхний уровень
    try:
        config = load_config()
        print(config)
    except FileReadError as e:
        print(f"[ОШИБКА] Не удалось загрузить конфигурацию: {e}")


start_application()
