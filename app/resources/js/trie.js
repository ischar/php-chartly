class TrieNode {
  constructor() {
    this.children = {};
    this.isEndOfWord = false;
  }
}

class Trie {
  constructor() {
    this.root = new TrieNode();
  }

  insert(word) {
    let node = this.root;
    for (const char of word) {
      if (!node.children[char]) {
        node.children[char] = new TrieNode();
      }
      node = node.children[char];
    }
    node.isEndOfWord = true;
  }

  search(prefix) {
    let node = this.root;
    for (const char of prefix) {
      if (!node.children[char]) {
        return [];
      }
      node = node.children[char];
    }
    return this._getWordsFromNode(node, prefix);
  }

  _getWordsFromNode(node, prefix) {
    const results = [];
    if (node.isEndOfWord) {
      results.push(prefix);
    }
    for (const char in node.children) {
      results.push(...this._getWordsFromNode(node.children[char], prefix + char));
    }
    return results;
  }
}

export { Trie, TrieNode };
