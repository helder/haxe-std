package helder;

import haxe.macro.Type;
import haxe.macro.Context;

using haxe.macro.TypeTools;

class Std {
  static final stdPaths = ['haxe', 'sys'];

  public static function use() {
    #if php
    excludeAsNative(['php'].concat(stdPaths), (pack, type) -> {
      final native = ['helder', 'std'].concat(pack.split('.'))
        .concat([type.name])
        .join('\\');
      type.meta.add(':native', [macro $v{native}], type.pos);
    });
    #elseif genes
    excludeAsNative(['js', 'genes'].concat(stdPaths), (pack, type) -> {
      final path = type.module.split('.');
      final name = type.name;
      final from = ['helder.std'].concat(path).join('/');
      type.meta.add(':jsRequire', [macro $v{from}, macro $v{name}], type.pos);
    });
    #end
  }

  static function includesPack(packs: Array<String>, pack: String) {
    for (p in packs)
      if (StringTools.startsWith(pack, p + '.'))
        return true;
    return false;
  }

  static function excludeAsNative(packs: Array<String>,
      makeNative: (pack: String, type: BaseType) -> Void) {
    Context.onGenerate(function(types) {
      for (type in types) {
        switch type {
          case TInst((_.get() : BaseType) => base, _) |
            TEnum((_.get() : BaseType) => base, _):
            final pack = base.pack.join('.');
            if (pack != '' && !includesPack(packs, pack))
              continue;
            if (base.isExtern)
              continue;
            final meta = base.meta;
            if (!meta.has(":nativeGen")) {
              meta.add(":hxGen", [], base.pos);
              makeNative(pack, base);
            }
            base.exclude();
          default:
            continue;
        }
      }
    }, false);
  }
}
