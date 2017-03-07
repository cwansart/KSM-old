# Use this script to collect all sql data in data.sql. This helps to easily
# run the sql queries at once.

$dataFilename = "$PSScriptRoot\data.sql"
Get-Content $PSScriptRoot\*\*.sql > $dataFilename

