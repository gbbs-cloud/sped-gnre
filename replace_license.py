import os
import re

def replace_license_header(file_path):
    # More general pattern: /* or /** followed by anything, then GNU, then anything, then */
    old_license_pattern = r"""/\*\*?.*?GNU.*?\*/"""
    new_license_header = """/**
 * SPDX-License-Identifier: GPL-3.0-or-later
 * Part of GNRE PHP – see LICENSE.md in the project root for details.
 */"""

    with open(file_path, 'r') as f:
        content = f.read()

    # Use re.DOTALL to make '.' match newlines
    new_content = re.sub(old_license_pattern, new_license_header, content, flags=re.DOTALL)

    if new_content != content:
        with open(file_path, 'w') as f:
            f.write(new_content)
        print(f"Updated license header in: {file_path}")
    else:
        print(f"No license header found or already updated in: {file_path}")

def main():
    dirs_to_scan = [
        "/home/joao/dev/work/sped-gnre/lib",
        "/home/joao/dev/work/sped-gnre/testes"
    ]
    for scan_dir in dirs_to_scan:
        for root, _, files in os.walk(scan_dir):
            for file in files:
                if file.endswith(".php"):
                    file_path = os.path.join(root, file)
                    replace_license_header(file_path)

if __name__ == "__main__":
    main()