#!/usr/bin/env sh

#### it requires new version number
if [ -z "$1" ]; then
  echo "Error: please provide a version string"
  exit 1
fi
version="$1"

#### Build new changelog
{
  echo ""
  echo "## $version - $(date +%Y-%m-%d)"
  echo "----"
} >>CHANGELOG.md.0
git log $(git describe --tags --abbrev=0)..HEAD |
  grep "^(changelog)" >>CHANGELOG.md.0

#### prepend changelog
cat CHANGELOG.md >>CHANGELOG.md.0
mv CHANGELOG.md.0 CHANGELOG.md

# portable solution in perl
perl -pi -e "s/const SDK_VERSION = .*\;/const SDK_VERSION = \'$version\'\;/" \
  src/Constants.php

echo "Done! Ready to commit and release $version!"
