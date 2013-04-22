VERSION ?= false

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
ZF2_MASTER_INFO := $(shell $(CURDIR)/bin/zf2-update.sh $(ZF2_DIR) master $(GIT))
ZF2_DEVELOP_INFO := $(shell $(CURDIR)/bin/zf2-update.sh $(ZF2_DIR) develop $(GIT))

.PHONY : all push tag update-develop update-master verify-version

all : update-master update-develop
	@echo "PREVIOUS master revision info:  $(ZF2_MASTER_PREV)"
	@echo "PREVIOUS develop revision info: $(ZF2_DEVELOP_PREV)"
	@echo "NEW master revision info:       $(ZF2_MASTER_INFO)"
	@echo "NEW develop revision info:      $(ZF2_DEVELOP_INFO)"

update-master :
ifneq "$(ZF2_MASTER_PREV)" "$(ZF2_MASTER_INFO)"
	@echo "Updating master branch..."
	-$(PHP) $(CURDIR)/bin/components-update.php "$(ZF2_DIR)" "master" "$(ZF2_MASTER_PREV)" "$(REPOS_DIR)" "$(GIT)" "$(RSYNC)"
	@echo "[DONE] Updating master branch."
else
	-echo $(ZF2_MASTER_INFO) > $(ZF2_MASTER_MARKER)
	@echo "Master branch is already up-to-date"
endif

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

push :
	@echo "Pushing component repositories..."
	-$(PHP) $(CURDIR)/bin/push-repos.php "$(GIT)" "$(REPOS_DIR)"
	@echo "[DONE] Pushing component repositories."
