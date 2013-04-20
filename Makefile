GIT ?= git
PHP ?= php
RSYNC ?= rsync

REPOS_DIR = $(CURDIR)/repos
ZF2_DIR = $(REPOS_DIR)/zf2

# This ensures the ZF2 repo is up-to-date, and provides the current SHA1 and TS
# of the latest revision on master and develop, respectively
ZF2_MASTER_PREV := $(shell cat $(CURDIR)/data/master)
ZF2_DEVELOP_PREV := $(shell cat $(CURDIR)/data/develop)
ZF2_MASTER_INFO := $(shell $(CURDIR)/bin/zf2-update.sh $(ZF2_DIR) master $(GIT))
ZF2_DEVELOP_INFO := $(shell $(CURDIR)/bin/zf2-update.sh $(ZF2_DIR) develop $(GIT))

.PHONY: all

define component_update_branch
branch=$1
$$(branch) : 
	@echo "Updating components on branch $$@..."
ifeq ($$@,master)
	-$(PHP) $(CURDIR)/bin/components-update.php "$(ZF2_DIR)" "master" "$(ZF2_MASTER_INFO)" "$(REPOS_DIR)" "$(GIT)" "$(RSYNC)"
endif
ifeq ($$@,develop)
	-$(PHP) $(CURDIR)/bin/components-update.php "$(ZF2_DIR)" "develop" "$(ZF2_DEVELOP_INFO)" "$(REPOS_DIR)" "$(GIT)" "$(RSYNC)"
endif
	@echo "[DONE] Updating components on branch $$@."
endef

all:
	@echo "Previous master revision info: $(ZF2_MASTER_PREV)"
	@echo "Previous develop revision info: $(ZF2_DEVELOP_PREV)"
	@echo "Current master revision info: $(ZF2_MASTER_INFO)"
	@echo "Current develop revision info: $(ZF2_DEVELOP_INFO)"

