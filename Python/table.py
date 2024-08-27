from rich.console import Console
from rich.table import Table

console = Console()


table = Table(show_header=True, header_style="bold magenta", show_lines=True, row_styles=["dim", ""])
table.add_column("Page", justify="start", style="cyan")
table.add_column("Meta Title", justify="start", style="green")
table.add_column("Meta Description", justify="start")
table.add_column("Og image", justify="start")


table.add_row(
    page_title,
    result_title,
    result_description,
    result_image
)
