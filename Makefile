VERSION ?= false
BRANCH ?= false

GIT ?= git
PHP ?= php
RSYNC ?= rsync

REPOS_DIR = $(CURDIR)/repos
ZF2_DIR = $(REPOS_DIR)/zf2

# This ensures the ZF2 repo is up-to-date, and provides the current SHA1 and TS
# of the latest revision on master and develop, respectively
ZF2_MASTER_MARKER = $(CURDIR)/data/master
ZF2_DEVELOP_MARKER = $(CURDIR)/data/develop
ZF2_MASTER_PREV := $(shell cat $(ZF2_MASTER_MARKER))
ZF2_DEVELOP_PREV := $(shell cat $(ZF2_DEVELOP_MARKER))

.PHONY : all push tag update-develop update-master usage verify-version

all : usage

usage : ZF2_MASTER_INFO = $(shell $(CURDIR)/bin/zf2-update.sh $(ZF2_DIR) master $(GIT))
usage : ZF2_DEVELOP_INFO = $(shell $(CURDIR)/bin/zf2-update.sh $(ZF2_DIR) develop $(GIT))
usage :
	@echo "This is a summary of what will happen if you update:"
	@echo ""
	@echo "PREVIOUS master revision info:  $(ZF2_MASTER_PREV)"
	@echo "PREVIOUS develop revision info: $(ZF2_DEVELOP_PREV)"
	@echo "NEW master revision info:       $(ZF2_MASTER_INFO)"
	@echo "NEW develop revision info:      $(ZF2_DEVELOP_INFO)"
	@echo ""
	@echo "Run 'make update-master' and/or 'make update-develop', followed by 'make push'"
	@echo "in order to update the repositories."
	@echo ""
	@echo "Run 'make tag VERSION=<version>' to release a new tag."
	@echo "Do this only after running 'update-master'!"

update-master : ZF2_MASTER_INFO = $(shell $(CURDIR)/bin/zf2-update.sh $(ZF2_DIR) master $(GIT))
update-master :
ifneq "$(ZF2_MASTER_PREV)" "$(ZF2_MASTER_INFO)"
	@echo "Updating master branch..."
	-$(PHP) $(CURDIR)/bin/components-update.php "$(ZF2_DIR)" "master" "$(ZF2_MASTER_PREV)" "$(REPOS_DIR)" "$(GIT)" "$(RSYNC)"
	-echo $(ZF2_MASTER_INFO) > $(ZF2_MASTER_MARKER)
	@echo "[DONE] Updating master branch."
else
	@echo "Master branch is already up-to-date"
endif

update-develop : ZF2_DEVELOP_INFO = $(shell $(CURDIR)/bin/zf2-update.sh $(ZF2_DIR) develop $(GIT))
update-develop : 
ifneq "$(ZF2_DEVELOP_PREV)" "$(ZF2_DEVELOP_INFO)"
	@echo "Updating develop branch..."
	-$(PHP) $(CURDIR)/bin/components-update.php "$(ZF2_DIR)" "develop" "$(ZF2_DEVELOP_PREV)" "$(REPOS_DIR)" "$(GIT)" "$(RSYNC)"
	-echo $(ZF2_DEVELOP_INFO) > $(ZF2_DEVELOP_MARKER)
	@echo "[DONE] Updating develop branch."
else
	@echo "Develop branch is already up-to-date"
endif

tag : verify-version update-master
	@echo "Tagging components for ZF2 version $(VERSION)..."
	-$(PHP) $(CURDIR)/bin/components-tag.php "$(VERSION)" "$(ZF2_DIR)" "$(REPOS_DIR)" "$(GIT)"
	@echo "[DONE] Tagging components."

verify-version :
ifeq ($(VERSION),false)
	@echo "Missing version; please provide VERSION via the commandline"
	-exit 1
endif

push : verify-branch
	@echo "Pushing component repositories..."
	-$(PHP) $(CURDIR)/bin/push-repos.php "$(BRANCH)" "$(GIT)" "$(ZF2_DIR)" "$(REPOS_DIR)"
	@echo "[DONE] Pushing component repositories."

verify-branch :
ifeq "$(BRANCH)" "master"
	@echo "Updating master branch"
else
ifeq "$(BRANCH)" "develop"
	@echo "Updating develop branch"
else
ifeq "$(BRANCH)" "tags"
	@echo "Updating tags"
else
	@echo "Invalid or missing branch; please provide BRANCH via the commandline"
	@echo "BRANCH may be one of 'master', 'develop', or 'tags'"
	exit 1
endif
endif
endif
