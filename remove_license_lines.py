import os

def remove_license_lines(file_path):
    new_lines = []
    changed = False
    with open(file_path, 'r') as f:
        for line in f:
            if '@license' in line:
                changed = True
            else:
                new_lines.append(line)

    if changed:
        with open(file_path, 'w') as f:
            f.writelines(new_lines)
        print(f"Removed @license lines from: {file_path}")
    else:
        print(f"No @license lines found in: {file_path}")

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
                    remove_license_lines(file_path)

if __name__ == "__main__":
    main()
