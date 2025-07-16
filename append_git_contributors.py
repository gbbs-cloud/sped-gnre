import os
import re
import subprocess

def get_existing_contributors(file_path):
    contributors = set()
    if os.path.exists(file_path):
        with open(file_path, 'r') as f:
            for line in f:
                # Match lines starting with '- ' and capture the rest
                match = re.match(r'- (.*)', line.strip())
                if match:
                    contributors.add(match.group(1).strip())
    return contributors

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
                authors_set.add(author_info.strip())
    except subprocess.CalledProcessError as e:
        print(f"Error getting git authors: {e}")
    except FileNotFoundError:
        print("Git command not found. Please ensure Git is installed and in your PATH.")

def main():
    contributors_file = "/home/joao/dev/work/sped-gnre/CONTRIBUTORS.md"
    
    # Get existing contributors from the file
    all_authors = get_existing_contributors(contributors_file)

    print("Fetching authors from Git history...")
    get_git_authors(all_authors)

    sorted_authors = sorted(list(all_authors))

    print(f"Updating {contributors_file}...")
    with open(contributors_file, 'w') as f:
        f.write("# Contributors\n\n")
        if sorted_authors:
            for author in sorted_authors:
                f.write(f"- {author}\n")
        else:
            f.write("No contributors found.\n")
    print(f"Successfully updated {contributors_file} with {len(sorted_authors)} unique contributors.")

if __name__ == "__main__":
    main()