import os
import re
import subprocess

def process_php_files(dirs_to_scan, authors_set):
    for scan_dir in dirs_to_scan:
        for root, _, files in os.walk(scan_dir):
            for file in files:
                if file.endswith(".php"):
                    file_path = os.path.join(root, file)
                    new_lines = []
                    changed = False
                    with open(file_path, 'r') as f:
                        for line in f:
                            if '@author' in line:
                                changed = True
                                match = re.search(r'@author\s+(.*?)(?:\s+<.*?>)?', line)
                                if match:
                                    author_name = match.group(1).strip()
                                    if author_name:
                                        authors_set.add(author_name)
                            else:
                                new_lines.append(line)

                    if changed:
                        with open(file_path, 'w') as f:
                            f.writelines(new_lines)
                        print(f"Removed @author lines from: {file_path}")

def get_git_authors(authors_set):
    try:
        # Get author names and emails from git log
        result = subprocess.run(
            ['git', 'log', '--pretty=format:%an <%ae>'],
            capture_output=True, text=True, check=True
        )
        git_authors = result.stdout.strip().split('\n')
        for author_info in git_authors:
            if author_info:
                # Extract just the name part, or the whole string if no email is present
                match = re.match(r'(.*?)\s*<.*?>', author_info)
                if match:
                    authors_set.add(match.group(1).strip())
                else:
                    authors_set.add(author_info.strip())
    except subprocess.CalledProcessError as e:
        print(f"Error getting git authors: {e}")
    except FileNotFoundError:
        print("Git command not found. Please ensure Git is installed and in your PATH.")

def main():
    contributors_file = "/home/joao/dev/work/sped-gnre/CONTRIBUTORS.md"
    dirs_to_scan = [
        "/home/joao/dev/work/sped-gnre/lib",
        "/home/joao/dev/work/sped-gnre/testes"
    ]
    
    authors_set = set()

    print("Processing PHP files for @author tags...")
    process_php_files(dirs_to_scan, authors_set)

    print("Fetching authors from Git history...")
    get_git_authors(authors_set)

    sorted_authors = sorted(list(authors_set))

    print(f"Creating {contributors_file}...")
    with open(contributors_file, 'w') as f:
        f.write("# Contributors\n\n")
        if sorted_authors:
            for author in sorted_authors:
                f.write(f"- {author}\n")
        else:
            f.write("No contributors found.\n")
    print(f"Successfully created {contributors_file} with {len(sorted_authors)} unique contributors.")

if __name__ == "__main__":
    main()
