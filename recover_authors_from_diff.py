import subprocess
import os
import re

def recover_and_append_authors(contributors_file):
    try:
        # Run git diff
        result = subprocess.run(
            ['git', 'diff'],
            capture_output=True, text=True, check=True
        )
        diff_output = result.stdout

        authors_to_append = []
        for line in diff_output.splitlines():
            # Check if the line was removed and contains '@author'
            if line.startswith('-') and '@author' in line:
                # Extract content after '-' and any leading whitespace
                match = re.match(r'^-?\s*(.*@author.*)', line)
                if match:
                    authors_to_append.append(match.group(1).strip())

        if authors_to_append:
            with open(contributors_file, 'a') as f: # Open in append mode
                for author_line in authors_to_append:
                    f.write(f"{author_line}\n")
            print(f"Appended {len(authors_to_append)} @author lines from git diff to {contributors_file}.")
        else:
            print("No @author lines found in git diff to append.")

    except subprocess.CalledProcessError as e:
        print(f"Error running git diff: {e}")
    except FileNotFoundError:
        print("Git command not found. Please ensure Git is installed and in your PATH.")

def main():
    contributors_file = "/home/joao/dev/work/sped-gnre/CONTRIBUTORS.md"
    recover_and_append_authors(contributors_file)

if __name__ == "__main__":
    main()
