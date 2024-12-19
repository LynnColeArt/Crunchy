import os

def create_crunchy_project(project_name):
    """Create a CRUNCHY project directory structure."""
    
    # Base directory structure
    directories = [
        '',  # Root directory
        'config',
        'patterns',
        'sections',
        'lib'
    ]
    
    # Files to create
    files = {
        'main.crunch': '',
        'lyrics.crunch': '',
        'config/constants.crunch': '',
        'config/instrumentation.crunch': '',
        'config/mixing-profiles.crunch': '',
        'patterns/melody.crunch': '',
        'patterns/rhythm.crunch': '',
        'patterns/drums.crunch': '',
        'patterns/fiddle.crunch': '',
        'sections/verse.crunch': '',
        'sections/chorus.crunch': '',
        'sections/bridge.crunch': '',
        'sections/solo.crunch': '',
        'lib/transforms.crunch': '',
        'lib/utils.crunch': ''
    }
    
    # Create directories
    for dir_name in directories:
        full_path = os.path.join(project_name, dir_name)
        os.makedirs(full_path, exist_ok=True)
        print(f"Created directory: {full_path}")
    
    # Create files
    for file_name, content in files.items():
        full_path = os.path.join(project_name, file_name)
        with open(full_path, 'w') as f:
            f.write(content)
        print(f"Created file: {full_path}")

if __name__ == "__main__":
    project_name = input("Enter project name: ")
    create_crunchy_project(project_name)
    print(f"\nCRUNCHY project '{project_name}' has been created!")
