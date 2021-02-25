#!/bin/bash
while true
do
# Echo current date to stdout
echo `date`
# Echo 'error!' to stderr
echo 'error message shows here' >&2
sleep 1
done
