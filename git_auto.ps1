# Prompt for commit message
$commitMessage = Read-Host "Enter commit message"

# Run Git commands
git add .
git commit -m "$commitMessage"
git push
