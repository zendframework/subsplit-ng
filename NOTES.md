Subsplit Next-Generation
========================

Algorithm: Updating branches
----------------------------

- [X] Marker file containing sha of last commit on ZF2 used to update subsplits.
    - This should likely be under version control, so that we can spin up the
      process from any machine.
- [X] For each branch (master, develop):
    - [X] `git fetch` && `git checkout {branch}` && `git rebase origin/{branch}`
    - [X] get sha1 of most recent commit
      `CURRENT_SHA1=$(git log -1 --format=format:"%H")`
    - [X] get timestamp from last update
      `PREVIOUS_TS=$(git log --format=format:"%ct" $PREVIOUS_SHA1`
    - get list of revisions since last update
      `REVISIONS=$(git log --format=format:"%H" --since=$($PREVIOUS_TS + 1) --reverse`
    - loop through revisions (they're already in reverse order) and get list of
      files changed

      for REVISION in $REVISIONS;do
          FILES=`git show --name-only --format=format:"%b" $REVISION`
          # Determine components from here
          # Update appropriate component repos with files
          #     use rsync, with the option to delete files on the target not on
          #     the source
          # Commit component repo, providing sync $REVISION in commit message
          #     `git add .` and `git commit -a -m "Sync with zendframework/zf2@$REVISION"
          #     The "-a" switch will both add AND delete files it previously
          #     knew about
      done

- Update marker file with ZF2 sha1

Algorithm: Creating tags
------------------------

- Get sha1 of tag from ZF2 repo, and timestamp of that sha1
- For each component:
  - Get revision of last commit on component's master
  - If revision == zf2 tag sha1, tag; done
  - Get date of last commit on component's master
    - If date < zf2 tag date, tag; done
    - Traverse revisions on component in reverse order
      `git log -{X} --format=format:"%H %ct"` (where X starts at 2) will work;
      pop off the last one to get the SHA1+TS of that commit
        - If sha1 == zf2 tag sha1, tag; done
        - If date <= zf2 tag date, tag; done

Tricks
------

- Show timestamp of a single commit:
    ```sh
    git log --format=format:"%ct" <sha1>
    ```
