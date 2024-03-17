def main() -> None:
	book_path = "books/frankenstein.txt"
	text = get_book_text(book_path)
	word_count = get_num_words(text)
	chars_dict = get_chars_dict(text)
	chars_sorted_list = chars_dict_to_sorted_list(chars_dict)

	print(f"--- Begin report of {book_path} ---")
	print(f"{word_count} words found in the document")
	print()

	for item in chars_sorted_list:
		if not item["char"].isalpha():
			continue
		print(f"The '{item['char']}' character was found {item['num']} times")
	print("--- End report ---")

def get_book_text(book_path: str) -> str:
	with open(book_path) as f:
		return f.read()

def get_num_words(text: str) -> int:
	words = text.split()
	return len(words)

def get_chars_dict(text: str) -> dict[str, int]:
	chars: dict[str, int] = {}
	for c in text:
		lowered = c.lower()
		if lowered in chars:
			chars[lowered] += 1
		else:
			chars[lowered] = 1
	return chars

def sort_on(list: list[dict[str, str|int]]) -> int:
	return list["num"]

def chars_dict_to_sorted_list(chars_dict: dict[str, int]) -> list[dict[str, int|str]]:
	sorted_list: list[dict[str, str|int]] = []
	for ch in chars_dict:
		sorted_list.append({"char": ch, "num": chars_dict[ch]})
	sorted_list.sort(reverse=True, key=sort_on)
	return sorted_list

main()